<?php

namespace Member\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Member\Model\MedicalRecordEntity;

use Gumlet\ImageResize;

use Web3\Web3;
use Web3\Contract;

class IndexController extends AbstractActionController
{
  public function getIncentiveMapper()
  {
    $sm = $this->getServiceLocator();
    return $sm->get('IncentiveMapper');
  }

  public function getProductMapper()
  {
    $sm = $this->getServiceLocator();
    return $sm->get('ProductMapper');
  }

  public function getUserMapper()
  {
    $sm = $this->getServiceLocator();
    return $sm->get('UserMapper');
  }

  public function getMedicalRecordMapper()
  {
    $sm = $this->getServiceLocator();
    return $sm->get('MedicalRecordMapper');
  }

  public function getHospitalMapper()
  {
    $sm = $this->getServiceLocator();
    return $sm->get('HospitalMapper');
  }

  public function indexAction()
  {
    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $page = $this->params()->fromRoute('page');
    $search_by = $this->params()->fromRoute('search_by') ? $this->params()->fromRoute('search_by') : '';

		$filter = array();
		if (!empty($search_by)) {
			$filter = (array) json_decode($search_by);
		}

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

    $medicalRecords = array();
    if($user->getRole() == 'patient'){
      $config = $this->getServiceLocator()->get('Config');
      $web3 = new Web3($config['ethereum']['Web3 Provider Endpoint']);
      $abi = $config['ethereum']['ABI'];
      $contract = new Contract($web3->provider, $abi);
      $contractAddress = $config['ethereum']['Contract Address'];
      $patient_public_address = $user->getPublicAddress();

      // count
      $medicalRecordCount = 0;
      $contract->at($contractAddress)->call('getMedicalRecordCount', ['from' => $patient_public_address], function($error, $result) use (&$medicalRecordCount){
        // print_r($error);
        /// print_r($result);
        if ($error !== null) {
          throw $error;
        }
        $medicalRecordCount = $result[0]->value;
      });

      // history
      if($medicalRecordCount > 0){
        for($ctr = 0; $ctr < $medicalRecordCount; $ctr++){
          $contract->at($contractAddress)->call('read', $ctr, ['from' => $patient_public_address], function($error, $result) use (&$medicalRecords){
            // print_r($error);
            // print_r($result);
            if ($error !== null) {
              throw $error;
            }

            $medicalRecords[] = array(
              'hospital' => $result[2],
              'doctor' => $result[3],
              'diagnostics' => $result[4],
              'prescriptions' => $result[5],
              'time' => $result[6]->value,
            );
          });
        }
      }
    }

		return new ViewModel(array(
      'route' => $route,
      'action' => $action,
      'user' => $user,
      'medicalRecords' => $medicalRecords,
		));
	}

  public function tagCashAction()
  {
    $config = $this->getServiceLocator()->get('Config');

    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $page = $this->params()->fromRoute('page');
    $search_by = $this->params()->fromRoute('search_by') ? $this->params()->fromRoute('search_by') : '';

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

    $id = (int)$this->params('id');
    if (!$id) {
      return $this->redirect()->toRoute('member', array('action'=>'portal'));
    }

    if($this->getRequest()->isPost()) {
      $data = $this->params()->fromPost();

      $wallet = $data['wallet'];
      $amount = $data['amount'];
      $email = $data['email'];
      $pin = $data['pin'];

      header("Content-Type: application/json; charset=UTF-8");
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, "https://apibeta.tagcash.com/oauth/accesstoken");
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);

       $data = array(
          "client_id" => $config['tagcash']['CLIENT ID'],
          "client_secret" => $config['tagcash']['CLIENT SECRET'],
          "grant_type" => "client_credentials"
       );
       curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

       $contents = curl_exec($ch);
       $obj = json_decode($contents, false);

       $result = $obj->result;
       $accesstoken = $result->access_token;

       if(!$accesstoken){
          $this->flashMessenger()->setNamespace('error')->addMessage('Merchant Access Token Is Not Found');
          return $this->redirect()->toRoute('member', ['action' => 'portal',]);
       }

       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, "https://apibeta.tagcash.com/wallet/charge");
       curl_setopt($ch, CURLOPT_HEADER, 0);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_POST, 1);

       $data = array(
          "access_token" => $accesstoken,
          "amount" => $amount,
          "pin" => $pin,
          "from_id" => $email,
          "wallet_id" => $wallet
       );

       curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
       $contents = curl_exec($ch);
       $contents = json_decode($contents);

       /*
       if(isset($contents->error)){
          $this->flashMessenger()->setNamespace('error')->addMessage('Pay using tagcash failed');
          return $this->redirect()->toRoute('member', ['action' => 'portal',]);
       }

       if(isset($contents->result)){
          $this->flashMessenger()->setNamespace('success')->addMessage('Pay using tagcash done successfully');
          return $this->redirect()->toRoute('member', ['action' => 'video',]);
       }
       */
       $this->flashMessenger()->setNamespace('success')->addMessage('Pay using tagcash done successfully');
       return $this->redirect()->toRoute('member', ['action' => 'video', 'id' => $id, 'status' => 'success']);
    }

		return new ViewModel(array(
      'route' => $route,
      'action' => $action,
      'user' => $user,
		));
	}

  public function createAction()
  {
    $config = $this->getServiceLocator()->get('Config');
    $web3 = new Web3($config['ethereum']['Web3 Provider Endpoint']);
    $abi = $config['ethereum']['ABI'];
    $contract = new Contract($web3->provider, $abi);
    $contractAddress = $config['ethereum']['Contract Address'];

    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

    $patient_public_address = $this->params()->fromQuery('public_address');
    if (!$patient_public_address) {
      return $this->redirect()->toRoute('member');
    }
    $patient = $this->getUserMapper()->getUserByPublicAddress($patient_public_address);
    if(!$patient){
      $this->flashMessenger()->setNamespace('error')->addMessage('Invalid User.');
      return $this->redirect()->toRoute('member');
    }

    $form = $this->getServiceLocator()->get('MedicalRecordForm');
    $medicalRecord = new MedicalRecordEntity();
    $form->bind($medicalRecord);
    if($this->getRequest()->isPost()) {
      $data = $this->params()->fromPost();

      $patient_public_address = $data['patient_public_address'];
      $doctor_public_address = $data['doctor_public_address'];
      $doctor = $data['doctor'];
      $hospital_id = $data['hospital_id'];
      $diagnostics = $data['diagnostics'];
      $prescriptions = $data['prescriptions'];

      $hospital = $this->getHospitalMapper()->getHospital($hospital_id);
      if(!$hospital){
        $this->flashMessenger()->setNamespace('error')->addMessage('Invalid Hospital.');
        return $this->redirect()->toRoute('member');
      }

      if($user->getGender() == 'f'){
        $title = "Dra.";
      }else{
        $title = "Dr.";
      }
      $doctor = $title . " " . $user->getFirstName() . " " . $user->getLastName();
      $time = time();

      $contract->at($contractAddress)->send('setMedicalRecord', $patient_public_address, $hospital->getName(), $doctor, $diagnostics, $prescriptions, $time, [
        'from' => $doctor_public_address,
        'gas' => '0x200b20'
      ], function($error, $result) use ($contract, $contractAddress, $patient_public_address){
        // print_r($error);
        // print_r($result);
        if ($error !== null) {
          throw $error;
        }
        if ($result) {
          // echo "\nTransaction has made:) id: " . $result . "\n";
          $this->flashMessenger()->setNamespace('success')->addMessage("Transaction successful. Transaction ID: " . $result);
          // return $this->redirect()->toRoute('member', array('action' => 'create',));
          header("Location: /member/create?public_address=" . $patient_public_address);
          exit();
        }
      });
    }else{
      $form->get('patient_public_address')->setValue($patient->getPublicAddress());
      $form->get('doctor_public_address')->setValue($user->getPublicAddress());
      if($user->getGender() == 'f'){
        $title = "Dra.";
      }else{
        $title = "Dr.";
      }
      $form->get('doctor')->setValue($title . " " . $user->getFirstName() . " " . $user->getLastName());
    }

    // count
    $medicalRecordCount = 0;
    $contract->at($contractAddress)->call('getMedicalRecordCount', ['from' => $patient_public_address], function($error, $result) use (&$medicalRecordCount){
      // print_r($error);
      /// print_r($result);
      if ($error !== null) {
        throw $error;
      }
      $medicalRecordCount = $result[0]->value;
    });

    // history
    $medicalRecords = array();
    if($medicalRecordCount > 0){
      for($ctr = 0; $ctr < $medicalRecordCount; $ctr++){
        $contract->at($contractAddress)->call('read', $ctr, ['from' => $patient_public_address], function($error, $result) use (&$medicalRecords){
          // print_r($error);
          // print_r($result);
          if ($error !== null) {
            throw $error;
          }

          $medicalRecords[] = array(
            'hospital' => $result[2],
            'doctor' => $result[3],
            'diagnostics' => $result[4],
            'prescriptions' => $result[5],
            'time' => $result[6]->value,
          );
        });
      }
    }

		return new ViewModel(array(
      'route' => $route,
      'action' => $action,
      'user' => $user,
      'patient' => $patient,
      'form' => $form,
      'medicalRecords' => $medicalRecords,
		));
	}

  public function profileAction()
  {
    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

		return new ViewModel(array(
      'route' => $route,
      'action' => $action,
      'user' => $user,
		));
	}

  public function scanAction()
  {
    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

		return new ViewModel(array(
      'route' => $route,
      'action' => $action,
      'user' => $user,
		));
	}

  public function videoAction()
  {
    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $status = $this->params('status');

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

    $id = (int)$this->params('id');
    if (!$id) {
      return $this->redirect()->toRoute('member', array('action'=>'doctors'));
    }
    $doctor = $this->getUserMapper()->getUser($id);
    if(!$doctor){
      $this->flashMessenger()->setNamespace('error')->addMessage('Invalid User.');
      return $this->redirect()->toRoute('member', array('action'=>'doctors'));
    }

    return new ViewModel([
      'user' => $user,
      'doctor' => $doctor,
      'route' => $route,
      'action' => $action,
      'status' => $status,
    ]);
  }

  public function portalAction()
  {
    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

    $page = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;
    $search_by = $this->params()->fromRoute('search_by') ? $this->params()->fromRoute('search_by') : '';

    $searchFilter = array();
    if (!empty($search_by)) {
      $searchFilter = (array) json_decode($search_by);
    }
    if($this->identity()->role == 'doctor'){
      $searchFilter['role'] = 'patient';
    }else{
      $searchFilter['role'] = 'doctor';
    }

    $order = array('first_name' , 'last_name');
    $paginator = $this->getUserMapper()->fetch(true, $searchFilter, $order);
    $paginator->setCurrentPageNumber($page);
    $paginator->setItemCountPerPage(12);

		return new ViewModel(array(
      'route' => $route,
      'action' => $action,
      'user' => $user,
      'paginator' => $paginator,
      'search_by' => $search_by,
      'page' => $page,
      'searchFilter' => $searchFilter,
		));
	}

  public function incentivesAction()
  {
    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $authService = $this->serviceLocator->get('auth_service');
    if (!$authService->getIdentity()) {
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

    $filter = array(
      'created_user_id' => $user->getId(),
    );
    $order=array();
    $incentives = $this->getIncentiveMapper()->getIncentives(false, $filter, $order);

    return new ViewModel([
      'incentives' => $incentives,
      'user' => $user,
      'route' => $route,
      'action' => $action,
    ]);
  }

  public function medicalRecordsAction()
  {
    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $page = $this->params()->fromRoute('page');
    $search_by = $this->params()->fromRoute('search_by') ? $this->params()->fromRoute('search_by') : '';

    $searchFilter = array();
    if (!empty($search_by)) {
      $searchFilter = (array) json_decode($search_by);
    }

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

    $order = array('created_datetime DESC');
    $paginator = $this->getMedicalRecordMapper()->fetch(true, $searchFilter, $order);
    $paginator->setCurrentPageNumber($page);
    $paginator->setItemCountPerPage(12);

		return new ViewModel(array(
      'route' => $route,
      'action' => $action,
      'user' => $user,

      'paginator' => $paginator,
      'search_by' => $search_by,
      'page' => $page,
      'searchFilter' => $searchFilter,
		));
	}

  public function pharmaceuticalAction()
  {
    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $page = $this->params()->fromRoute('page');
    $search_by = $this->params()->fromRoute('search_by') ? $this->params()->fromRoute('search_by') : '';

    $searchFilter = array();
    if (!empty($search_by)) {
      $searchFilter = (array) json_decode($search_by);
    }

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

    $order = array('created_datetime DESC');
    $paginator = $this->getProductMapper()->fetch(true, $searchFilter, $order);
    $paginator->setCurrentPageNumber($page);
    $paginator->setItemCountPerPage(12);

		return new ViewModel(array(
      'route' => $route,
      'action' => $action,
      'user' => $user,

      'paginator' => $paginator,
      'search_by' => $search_by,
      'page' => $page,
      'searchFilter' => $searchFilter,
		));
	}

  public function patientAction()
  {
    $route = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();
    $action = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch()->getParam('action');

    $page = $this->params()->fromRoute('page');
    $search_by = $this->params()->fromRoute('search_by') ? $this->params()->fromRoute('search_by') : '';

		$filter = array();
		if (!empty($search_by)) {
			$filter = (array) json_decode($search_by);
		}

    $user = $this->getUserMapper()->getUser($this->identity()->id);
    if(!$user){
      $this->flashMessenger()->setNamespace('error')->addMessage('You need to login or register first.');
      return $this->redirect()->toRoute('login');
    }

		return new ViewModel(array(
      'route' => $route,
      'action' => $action,
      'user' => $user,
		));
	}
}
