const path = require('path');
// const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const webpack = require('webpack');
const { VueLoaderPlugin } = require('vue-loader');

module.exports = {
    mode: 'development',
    entry: {
        main: './local/templates/fsk/assets/src/js/main.js',
    },
    output: {
        filename: 'main.min.js',
        path: path.resolve(__dirname, 'local/templates/fsk/assets/build')
    },
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        }
    },
    optimization: {
        minimizer: [
            new OptimizeCSSAssetsPlugin({
                assetNameRegExp: /\.optimize\.css$/g,
                cssProcessor: require('cssnano'),
                cssProcessorPluginOptions: {
                    preset: ['default', { discardComments: { removeAll: true } }],
                },
                canPrint: true
            })
        ]
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            // publicPath: 'bitrix/templates/fsk/assets/build/css/'
                        }
                    },
                    {
                        loader: 'css-loader',
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true,
                            includePaths: [
                                path.resolve(__dirname, './local/templates/fsk/assets/src/scss'),
                            ]
                        }
                    }
                ]
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: {
                    loaders: {
                        js: 'babel-loader'
                    },
                    // presets: ['@babel/preset-env'],
                    presets: [['@babel/preset-env', { modules: false }]]
                }
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader',
                options: {
                    presets: [['@babel/preset-env', { modules: false }]]
                }

            },
            {
              test: /\.(svg|png|jpg|gif)$/,
              use: {
                loader: "file-loader",
                options: {
                  name: "[name].[hash].[ext]",
                  outputPath: "imgs",
                  esModule: false,
                }
              }
            },
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader'
                ]
            },
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "[name].css",
        }),
        new VueLoaderPlugin()
    ]
};
