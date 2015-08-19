## 开发

主要介绍代码开发时 Smarty 解决方案提供的一些用法的使用。

### 模块化开发

FIS 把模板、js、css都纳入了模块化的范围，互相标记生成依赖树，统一做管理。而不像其他方案只针对于 js 做模块化处理。

#### 前端模块化框架

模块化开发是所有项目解耦复用等的必要手段，但是前端界模块化框架却是争议最大的地方。比如 AMD 规范、国内的 CMD 规范、CommonJS 规范甚至于每个团队都有一套这样的前端模块化框架。

很不凑巧，Smarty 解决方案中使用的是一个自定义的前端模块化框架 [mod.js](https://github.com/fex-team/mod)，是为 FIS 量身定做的。

在推广 FIS 的过程中，这个模块化框架也给 FIS 的推广带来了不少麻烦。不过为了性能、为了能让用户快乐的开发，面对这些麻烦是值得的。

用法

```
/static/add.js
/static/a.js
/static/b.js
/index.tpl
```

- define
    
    *add.js*
    
    ```js
    define('static/add.js', function (require, exports, module) {
        module.exports = function (a, b) {
            return a + b;
        }
    });
    ```

    *a.js*

    ```js
    define('static/a.js', function (require, exports, module) {
        var add = require('static/add.js');
        console.log(add(1,1)); // 2
    })
    ```

    *b.js*

    ```js
    define('static/b.js', function (require, exports, module) {
        var add = require('static/add.js');
        console.log(add(1,2)); // 3
    })
    ```

- require

    *index.tpl*

    ```html
    <script type="text/javascript" src="/static/a.js"></script>
    <script>
        require('static/a.js');
    </script>
    ```

- require.async

    *index.tpl*

    ```html
    <script type="text/javascript">
    require.resourceMap({
        'res': {
            'static/b.js': {
                url: '/static/b.js'
            }
        }
    });
    </script>
    <script>
        require.async('static/b.js');
    </script>
    ```

跟其他模块化前端框架一样，`define` 一个组件并且 `require` 使用它。其中 `require.async` 是异步加载组件而`require`同步加载组件。

同步加载的组件**必须在组件执行之前进行加载**，`mod.js` 不负责加载同步使用的组件，由用户或者后端程序负责给页面添加 `<script src="..."><script>` 进行加载。

异步加载的组件，由 `mod.js` 负责加载，但具体组件的 `url` 由用户或者后端程序设置 `require.resourceMap` 确定。

对于 js 组件的执行，只需要 `define (id ...)` 后就可以直接通过 `require(id)` 或者 `require.async(id)` 来执行它。

不管是同步还是异步组件，都需要提前加载、设定好具体 url 才能被正确执行。这个跟其他模块化框架是不一样的。**其他模块化框架可能执行 `require('a')` 会请求 a.js 并执行它，而不需要多余的处理。**

那么这么麻烦还怎么用呢？

Smarty 解决方案中通过后端模块化框架来完成这些事情。

- 分析组件以来，保持组件依赖顺序
- 同步使用组件在页面生成 `script`、`link` 让浏览器加载组件资源
- 异步组件生成 `require.resourceMap`

#### 后端模块化框架

上面针对于 JS 组件化做了一下说明，依赖分析交给了后端框架。后端框架计算依赖直接读取分析**静态资源映射表**，由构建工具生成。


### 前端模板的使用

前端模板在 FIS 都是需要进行预编译的，预编译成可执行的 JS 代码。在 Smarty 解决方案中前端模板后缀一般是 `.tmpl`，使用时需要提前配置。

```js
fis.match('*.tmpl', {
    rExt: '.js',
    parser: fis.plugin('utc') // underscore 中的模板引擎
});
```

或者

```js
fis.match('*.tmpl', {
    rExt: '.js',
    parser: fis.plugin('bdtmpl') // baiduTemplate
});
```

> 你也可以选择自己喜欢的前端模板，安装对应 FIS 解析插件即可。

那么在 js 中使用前端模板，直接 `__inline` 对应模板即可。

```js

var tmpl = __inline('./view.tmpl');

console.log(tmpl(data)); // render 出 html 结果

```

### Smarty插件

介绍提供的 Smarty 插件的使用方法；



