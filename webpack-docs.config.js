const path = require('path');
const glob = require('glob');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const { marked } = require('marked');
const fs = require('fs');

marked.setOptions({
    gfm: true
});

const mdFiles = glob.sync('src/docs/**/*.md');
const plugins = mdFiles.map((file) => {
    const relative = path.relative('src/docs', file);
    const outPath = relative.replace(/\.md$/, '.html');
    const content = marked(fs.readFileSync(file, 'utf8'));
    return new HtmlWebpackPlugin({
        filename: outPath,
        template: 'src/docs/template.html',
        templateParameters: {
            content
        },
        inject: false
    });
});

module.exports = {
    mode: 'production',
    entry: {},
    output: {
        path: path.resolve(__dirname, 'docs')
    },
    plugins
};
