const path = require("path");
const webpack = require("webpack");
const glob = require("glob");
const TerserPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const RemoveEmptyScriptsPlugin = require("webpack-remove-empty-scripts");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const PostCssPipelineWebpackPlugin = require("postcss-pipeline-webpack-plugin");
const Postcss = require("postcss");
const CriticalSplit = require("postcss-critical-split");
const Cssnano = require("cssnano");
const DiscardDuplicates = require("postcss-discard-duplicates");

let assets = [path.resolve(__dirname, 'assets/js/site-child.js'), path.resolve(__dirname, 'assets/scss/style.scss')];

var config = {
    entry: assets,
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: "[name].min.js",
    },
    plugins: [
        new RemoveEmptyScriptsPlugin(),

        // Extracts js to css
        new MiniCssExtractPlugin({
            filename: "[name].css",
        }),

        // A webpack plugin to remove/clean your build folder(s).
        new CleanWebpackPlugin(),

        // Output for critical css
        new PostCssPipelineWebpackPlugin({
            processor: Postcss([
                CriticalSplit({
                    output: CriticalSplit.output_types.CRITICAL_CSS,
                }),
            ]),
            transformName: (name) => 'critical-'+ name 
        }),

        // Output for regular css
        new PostCssPipelineWebpackPlugin({
            processor: Postcss([
                CriticalSplit({
                    output: CriticalSplit.output_types.REST_CSS,
                }),
            ]),
            transformName: (name) => name,
        }),

        // Removes the duplicates
        new PostCssPipelineWebpackPlugin({
            processor: Postcss([DiscardDuplicates()]),
            transformName: (name) => name,
        }),

        // CSS minification
        new PostCssPipelineWebpackPlugin({
            processor: Postcss([Cssnano()]),
            transformName: (name) => name,
        }),

        // Global (JS)
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
        }),
    ],
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ["@babel/preset-env"],
                        targets: {
                            browsers: [
                                "last 2 Chrome versions",
                                "last 2 Firefox versions",
                                "last 2 Safari versions",
                                "last 2 iOS versions",
                                "last 1 Android version",
                                "last 1 ChromeAndroid version",
                            ],
                        },
                    },
                },
            },
            {
                test: /\.s?css$/,
                exclude: /(node_modules|bower_components)/,
                use: [
                    // Creates `style` nodes from JS strings
                    MiniCssExtractPlugin.loader,
                    // Translates CSS into CommonJS
                    {
                        loader: "css-loader",
                        options: {
                            sourceMap: true,
                            url: false,
                        },
                    },
                    "postcss-loader",
                    // Compiles Sass to CSS
                    {
                        loader: "sass-loader",
                        options: {
                            sourceMap: false,
                            sassOptions: {
                                outputStyle: "expanded",
                            },
                        },
                    },
                ],
            },

        ],
    },
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin()],
    },
    externals: {
        jquery: "jQuery",
    },
};

module.exports = config;
