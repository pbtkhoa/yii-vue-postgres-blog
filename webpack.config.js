const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin')

module.exports = {
    entry: './frontend/resources/main.js',
    mode: 'development',
    output: {
        filename: 'build.js',
        chunkFilename: '[name].[chunkhash].js',
        publicPath: '/js/',
        path: path.resolve(__dirname, 'frontend/web/js')
    },
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            'vue$': 'vue/dist/vue.esm.js',
            '~': path.join(__dirname, './frontend/resources')
        },
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.js$/,
                loader: 'babel-loader'
            },
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader'
                ]
            },
            {
                test: /\.(jpe?g|png|gif)$/i,
                use: [
                    'url-loader?publicPath=&limit=10000&name=img/[name]-[hash:6].[ext]',
                    'image-webpack-loader?${JSON.stringify(imageLoaderQuery)}',
                ],
            }
        ]
    },
    plugins: [
        new VueLoaderPlugin()
    ],
};