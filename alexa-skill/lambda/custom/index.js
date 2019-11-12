/* eslint-disable  func-names */
/* eslint-disable  no-console */

const Alexa = require('ask-sdk-core');
const request = require('request');
const https = require('https');
const await = require('await');
const Promise = require('promise');

function getFood(food) {
  return new Promise(((resolve, reject) => {
    var options = {
        host: 'hangathon2019.gigamike.net',
        port: 443,
        path: '/api/nutrition-fact?food=' + food,
        method: 'GET',
    };

    const request = https.request(options, (response) => {
      response.setEncoding('utf8');
      let returnData = '';

      response.on('data', (chunk) => {
        returnData += chunk;
      });

      response.on('end', () => {
        resolve(JSON.parse(returnData));
      });

      response.on('error', (error) => {
        reject(error);
      });
    });
    request.end();
  }));
}

const LaunchRequestHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'LaunchRequest';
  },
  handle(handlerInput) {
    const speechText = 'Hello Mik Galon. Welcome to the Health Chain by team Gigamike. Do you want to check if your weight is healthy? just say get my body mass index. Or ask about food nutrition facts. Example, by saying nutrition facts for rice.';
    const repromptText = 'Do you want to check if your weight is healthy? just say get my body mass index. Or ask about food nutrition facts. Example, by saying nutrition facts for rice.';

    return handlerInput.responseBuilder
      .speak(speechText)
      .reprompt(speechText)
      .withSimpleCard('Welcome to the Health Chain by team Gigamike.', speechText)
      .getResponse();
  },
};

const GetBodyMassIndexIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetBodyMassIndexIntent';
  },
  handle(handlerInput) {
    const speechText = 'What is your height in centimeters? Just say my height is';
    const repromptText = 'What is your height in centimeters? Just say my height is';

    return handlerInput.responseBuilder
      .speak(speechText)
      .reprompt(speechText)
      .withSimpleCard('Get height in centimeters', speechText)
      .getResponse();
  },
};

const GetBodyMassIndexHeightIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetBodyMassIndexHeightIntent';
  },
  handle(handlerInput) {
    const attributes = handlerInput.attributesManager.getSessionAttributes();
    const heightCentimeters = handlerInput.requestEnvelope.request.intent.slots.HeightCentimeters.value;
    attributes.heightCentimeters = heightCentimeters;

    const speechText = 'You are ' + heightCentimeters + ' centimeters in height. What is your weight in kilograms? Just say my weight is';
    const repromptText = 'What is your weight in kilograms? Just say my weight is';

    return handlerInput.responseBuilder
      .speak(speechText)
      .reprompt(speechText)
      .withSimpleCard('Get weight in kilograms', speechText)
      .getResponse();
  },
};

const GetBodyMassIndexWeightIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetBodyMassIndexWeightIntent';
  },
  handle(handlerInput) {
    const attributes = handlerInput.attributesManager.getSessionAttributes();
    const weightKilograms = handlerInput.requestEnvelope.request.intent.slots.WeightKilograms.value;
    attributes.weightKilograms = weightKilograms;

    var speechText = '';
    const repromptText = '';
    var bmiResut = '';
    var bmi_category = '';

    if(attributes.heightCentimeters > 0 && attributes.weightKilograms > 0){
      var bmi = attributes.weightKilograms / (attributes.heightCentimeters / 100 * attributes.heightCentimeters / 100);

      if(bmi < 18.5){
        bmiResut = "Your B M I category is underweight.";
        bmi_category = 'underweight';
        speechText += 'You are ' + weightKilograms + ' kilograms in weight. ' + bmiResut + ".";
        speechText += 'I can recommend a diet for underweight by saying diet for underweight. Or I can recommend a gym program for underweight by saying gym program for underweight.';
      }else if(bmi >= 18.5 && bmi <= 24.9){
        bmiResut = "Your B M I category is normal weight."
        bmi_category = 'normal weight';
        speechText += 'You are ' + weightKilograms + ' kilograms in weight. ' + bmiResut + ".";
        speechText += 'Congratulations! Your physically fit. I can recommend a diet to maintain your normal weight by saying diet for normal weight. Or I can recommend a gym program to maintain your normal weight by saying gym program for normal weight.';
      }else if(bmi >= 25 && bmi <= 29.9){
        bmiResut = "Your B M I category is overweight."
        bmi_category = 'overweight';
        speechText += 'You are ' + weightKilograms + ' kilograms in weight. ' + bmiResut + ".";
        speechText += 'I can recommend a diet for overweight by saying diet for overweight. Or I can recommend a gym program for overweight by saying gym program for overweight.';
      }else if(bmi >= 30){
        bmiResut = "Your B M I category is obese."
        bmi_category = 'obese';
        speechText += 'You are ' + weightKilograms + ' kilograms in weight. ' + bmiResut + ".";
        speechText += 'I can recommend a diet for obese by saying diet for obese. Or I can recommend a gym program for obese by saying gym program for obese.';
      }

      var url = `https://hangathon2019.gigamike.net/api/bmi-add`
        + `?user_id=4`
        + `&height_centimeters=` + attributes.heightCentimeters
        + `&weight_kilograms=` + attributes.weightKilograms
        + `&bmi=` + bmi
        + `&bmi_category=` + bmi_category;
      request.get(url, (error, response, body) => {

      });
    }else{
      bmiResut = "Invalid entries!"
      speechText += bmiResut;
    }

    return handlerInput.responseBuilder
      .speak(speechText)
      .reprompt(speechText)
      .withSimpleCard('Get weight in kilograms', speechText)
      .getResponse();
  },
};

const GetDietForUnderweightIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetDietForUnderweightIntent';
  },
  handle(handlerInput) {
    var speechText = `Here is an example of a diet that will provide you with sufficient energy to assist with weight gain. `;
    speechText += `Foods that should be included every day.<break time="2s"/>`;
    speechText += `Full cream milk 750 to 1000 ml or 3 to 4 cups.<break time="2s"/>`;
    speechText += `Meat, fish, eggs and other protein foods 3 to 5 servings or 90 to 150 grams.<break time="2s"/>`;
    speechText += `Bread and cereals 8 to 12 servings e.g. up to 6 cups of starch a day.<break time="2s"/>`;
    speechText += `Fruit and vegetables 3to 5 servings.<break time="2s"/>`;
    speechText += `Fats and oils 90 grams 6 tablespoons.<break time="2s"/>`;
    speechText += `or Healthy desserts 1 to 2 servings`;

    return handlerInput.responseBuilder
      .speak(speechText)
      .withSimpleCard('Diet For Underweight', speechText)
      .getResponse();
  },
};

const GetDietForNormalWeightIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetDietForNormalWeightIntent';
  },
  handle(handlerInput) {
    var speechText = `Here is an example of a diet that will provide you with sufficient energy to assist with weight gain. `;
    speechText += `Foods that should be included every day.<break time="2s"/>`;
    speechText += `Full cream milk 750 to 1000 ml or 3 to 4 cups.<break time="2s"/>`;
    speechText += `Meat, fish, eggs and other protein foods 3 to 5 servings or 90 to 150 grams.<break time="2s"/>`;
    speechText += `Bread and cereals 8 to 12 servings e.g. up to 6 cups of starch a day.<break time="2s"/>`;
    speechText += `Fruit and vegetables 3to 5 servings.<break time="2s"/>`;
    speechText += `Fats and oils 90 grams 6 tablespoons.<break time="2s"/>`;
    speechText += `or Healthy desserts 1 to 2 servings`;

    return handlerInput.responseBuilder
      .speak(speechText)
      .withSimpleCard('Diet For Normal Weight', speechText)
      .getResponse();
  },
};

const GetDietForOverweightIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetDietForOverweightIntent';
  },
  handle(handlerInput) {
    var speechText = `Here is an example of a diet that will provide you with sufficient energy to assist with weight gain. `;
    speechText += `Foods that should be included every day.<break time="2s"/>`;
    speechText += `Full cream milk 750 to 1000 ml or 3 to 4 cups.<break time="2s"/>`;
    speechText += `Meat, fish, eggs and other protein foods 3 to 5 servings or 90 to 150 grams.<break time="2s"/>`;
    speechText += `Bread and cereals 8 to 12 servings e.g. up to 6 cups of starch a day.<break time="2s"/>`;
    speechText += `Fruit and vegetables 3to 5 servings.<break time="2s"/>`;
    speechText += `Fats and oils 90 grams 6 tablespoons.<break time="2s"/>`;
    speechText += `or Healthy desserts 1 to 2 servings`;

    return handlerInput.responseBuilder
      .speak(speechText)
      .withSimpleCard('Diet For Overweight', speechText)
      .getResponse();
  },
};

const GetDietForObeseIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetDietForObeseIntent';
  },
  handle(handlerInput) {
    var speechText = `Here is an example of a diet that will provide you with sufficient energy to assist with weight gain. `;
    speechText += `Foods that should be included every day.<break time="2s"/>`;
    speechText += `Full cream milk 750 to 1000 ml or 3 to 4 cups.<break time="2s"/>`;
    speechText += `Meat, fish, eggs and other protein foods 3 to 5 servings or 90 to 150 grams.<break time="2s"/>`;
    speechText += `Bread and cereals 8 to 12 servings e.g. up to 6 cups of starch a day.<break time="2s"/>`;
    speechText += `Fruit and vegetables 3to 5 servings.<break time="2s"/>`;
    speechText += `Fats and oils 90 grams 6 tablespoons.<break time="2s"/>`;
    speechText += `or Healthy desserts 1 to 2 servings`;

    return handlerInput.responseBuilder
      .speak(speechText)
      .withSimpleCard('Diet For Obese', speechText)
      .getResponse();
  },
};

const GetGymProgramForUnderweightIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetGymProgramForUnderweightIntent';
  },
  handle(handlerInput) {
    handlerInput.responseBuilder.addVideoAppLaunchDirective("https://gigamike-s3.s3.amazonaws.com/underweight.mp4", "Momoland", "boomboom");
    return handlerInput.responseBuilder.speak("Gym Program For Underweight").getResponse();
  },
};

const GetGymProgramForNormalWeightIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetGymProgramForNormalWeightIntent';
  },
  handle(handlerInput) {
    handlerInput.responseBuilder.addVideoAppLaunchDirective("https://gigamike-s3.s3.amazonaws.com/normalweight.mp4", "Gym Program For Normal Weight", "Gym Program For Normal Weight");
    return handlerInput.responseBuilder.speak("Gym Program For Normal Weight").getResponse();
  },
};

const GetGymProgramForOverweightIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetGymProgramForOverweightIntent';
  },
  handle(handlerInput) {
    handlerInput.responseBuilder.addVideoAppLaunchDirective("https://gigamike-s3.s3.amazonaws.com/overweight.mp4", "Gym Program For Overweight", "Gym Program For Overweight");
    return handlerInput.responseBuilder.speak("Gym Program For Overweight").getResponse();
  },
};

const GetGymProgramForObeseIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetGymProgramForObeseIntent';
  },
  handle(handlerInput) {
    handlerInput.responseBuilder.addVideoAppLaunchDirective("https://gigamike-s3.s3.amazonaws.com/obese.mp4", "Gym Program For Obese", "Gym Program For Obese");
    return handlerInput.responseBuilder.speak("Gym Program For Obese").getResponse();
  },
};

const GetNutritionFactIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'GetNutritionFactIntent';
  },
  async handle(handlerInput) {
    const food = handlerInput.requestEnvelope.request.intent.slots.Food.value;
    const response = await getFood(food);
    const speechText = response.text;

    return handlerInput.responseBuilder
      .speak(speechText)
      .withSimpleCard('Nutrition Facts for ' + food, speechText)
      .getResponse();
  },
};

const HelpIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && handlerInput.requestEnvelope.request.intent.name === 'AMAZON.HelpIntent';
  },
  handle(handlerInput) {
    const speechText = 'Welcome to the Health Chain by team Gigamike. Do you want to check if your weight is healthy? just say get my body mass index. Or ask about food nutrition facts. Example, by saying nutrition facts for rice.';
    const repromptText = 'Do you want to check if your weight is healthy? just say get body mass index. Or ask about food nutrition facts. Example, by saying nutrition facts for rice.';

    return handlerInput.responseBuilder
      .speak(speechText)
      .reprompt(speechText)
      .withSimpleCard('Welcome to the Health Chain by team Gigamike.', speechText)
      .getResponse();
  },
};

const CancelAndStopIntentHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'IntentRequest'
      && (handlerInput.requestEnvelope.request.intent.name === 'AMAZON.CancelIntent'
        || handlerInput.requestEnvelope.request.intent.name === 'AMAZON.StopIntent');
  },
  handle(handlerInput) {
    const speechText = 'Goodbye!';

    return handlerInput.responseBuilder
      .speak(speechText)
      .withSimpleCard('Welcome to the Health Chain by team Gigamike.', speechText)
      .getResponse();
  },
};

const SessionEndedRequestHandler = {
  canHandle(handlerInput) {
    return handlerInput.requestEnvelope.request.type === 'SessionEndedRequest';
  },
  handle(handlerInput) {
    console.log(`Session ended with reason: ${handlerInput.requestEnvelope.request.reason}`);

    return handlerInput.responseBuilder.getResponse();
  },
};

const ErrorHandler = {
  canHandle() {
    return true;
  },
  handle(handlerInput, error) {
    console.log(`Error handled: ${error.message}`);

    return handlerInput.responseBuilder
      .speak('Sorry, I can\'t understand the command. Please say again.')
      .reprompt('Sorry, I can\'t understand the command. Please say again.')
      .getResponse();
  },
};

const skillBuilder = Alexa.SkillBuilders.custom();

exports.handler = skillBuilder
  .addRequestHandlers(
    LaunchRequestHandler,
    GetBodyMassIndexIntentHandler,
    GetBodyMassIndexHeightIntentHandler,
    GetBodyMassIndexWeightIntentHandler,
    GetDietForUnderweightIntentHandler,
    GetDietForNormalWeightIntentHandler,
    GetDietForOverweightIntentHandler,
    GetDietForObeseIntentHandler,
    GetGymProgramForUnderweightIntentHandler,
    GetGymProgramForNormalWeightIntentHandler,
    GetGymProgramForOverweightIntentHandler,
    GetGymProgramForObeseIntentHandler,
    GetNutritionFactIntentHandler,
    HelpIntentHandler,
    CancelAndStopIntentHandler,
    SessionEndedRequestHandler
  )
  .addErrorHandlers(ErrorHandler)
  .lambda();
