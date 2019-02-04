const UglifyJSPlugin = require(`uglifyjs-webpack-plugin`);
const path = require('path');
const webpack = require('webpack');

module.exports = {
  devtool: `#eval-source-map`,
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      }
    ]
  }
};
