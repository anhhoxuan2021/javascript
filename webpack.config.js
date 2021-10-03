const webpack = require('webpack')
	const HtmlWebpackPlugin = require('html-webpack-plugin')
	//const ExtractTextPlugin = require("extract-text-webpack-plugin");
	module.exports = {
    entry: [
    'webpack-dev-server/client?http://localhost:8080',
    'webpack/hot/only-dev-server',
    './src/index.js'
  ],

  module: {
    loaders: [{
      test: /\.js?$/,
      exclude: /node_modules/,
			loader:'babel-loader',
			
      query: {
				   presets: ['es2015', 'react', 'stage-2']
				}
    },
		{
          test: /\.css$/,
					use: [ 'style-loader', 'css-loader' ],
				
		 },

		 { test: /\.(png|jpg|gif|svg|woff|woff2|ttf|eot|otf)$/, 
			loader: 'file-loader?name=./images/[name].[ext]' 
		}
	

	]
  },

	  output: {
		path: __dirname + '/build',
		publicPath: '/',
		filename: 'bundle.js'
	  },

	  devServer: {
		 historyApiFallback: true,
		 contentBase: './build',
		 hot: true,
		 port: 8080,
		 inline: true,
		 headers: {
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Credentials": "true",
      "Access-Control-Allow-Methods": "GET,HEAD,OPTIONS,POST,PUT",
      "Access-Control-Allow-Headers": "Origin, X-Requested-With, Content-Type, Accept, Authorization"
		}
	  },

	  plugins: [
		new HtmlWebpackPlugin({
		  template: 'public/index.html',
			inject: true,
			$: "jquery",
      jQuery: "jquery"
		}),
		
	//	new ExtractTextPlugin("[name].css")
	],

	node: {fs: 'empty'},
	externals: [
	  {'./cptable': 'var cptable'},
		{'./jszip': 'jszip'},
		
	]
	}
