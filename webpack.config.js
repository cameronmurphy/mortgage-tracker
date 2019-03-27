var _ = require('lodash');
var Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .addEntry('app', './assets/js/app.js')
  .addEntry('security', './assets/js/security.js')
  .enableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .enableSassLoader()
  .configureBabel(function(babelConfig) {
    const presetEnvPreset = _.find(babelConfig.presets, element => _.includes(element, '@babel/preset-env'));
    const presetEnvConfig = _.find(presetEnvPreset, _.isObject);
    _.set(presetEnvConfig, 'corejs', '3');
  })
;

module.exports = Encore.getWebpackConfig();
