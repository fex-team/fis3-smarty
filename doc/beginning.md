## 起步

### 开始前的说明

在开始介绍之前我不得不着重强调一下，fis3-smarty 已经以来了所有项目中以来的插件，默认[技术选型](#技术选型)下你不需要安装其他任何 fis 插件。

#### 技术选型

- js 模块化使用 **commonJS** 规范，模块框架 `mod.js`
- less 支持
- 前端模板选用 baiduTemplate

### 安装使用

通过 [README.md](../README.md) 可得知其使用方法

### 一个简单的例子

```
/demo/common
/demo/subsiteA
/demo/subsiteB
```

构造一个例子，其中包含三个模块，每一个模块对应是一个 FIS3 的项目。每一个模块对应一个 SVN 仓库。

> 业务小时，可以只包含一个模块；这三个模块也可以放到一个 SVN 仓库中。
>> 假设版本管理工具选择的是 SVN，当然也可以是 GIT 或其他，下同。


- common 模块包含公用的一些 widget 或 layout 以及可能的一些测试数据
- subsite* 子站模块
    
    > 当站点包含的代码量很大时，就需要考虑拆成子站来单独维护，这样互相上线不会受到干扰，而且也减轻了 SVN merge 的出错几率。

    举个例子，假设 [知道](https://zhidao.baidu.com) 站点，首页为一个模块、分类页作为一个模块、问题页作为一个模块等。


#### 目录结构

每一个模块的目录结构如下；

```
├── fis-conf.js
├── page
├── plugin
├── static
├── server.conf
├── smarty.conf
├── test
└── widget
```

|目录文件|解释|作用范围|
|:------|:---------|:-----------------|
|widget| 放一些 widget，里面代码最终会被组件化封装，需要 require 才能执行|逻辑代码，最终上线|
|page|   放一些页面，子站可能有多个页面|逻辑代码，最终上线|
|plugin| 有一些 Smarty 的插件放入这个目录，当然一般只需要一个模块拥有即可，比如 common|逻辑代码，最终上线|
|static|非组件静态资源|逻辑代码，最终上线|
|test|   测试数据，放一些模拟数据|本地模拟测试使用|
|server.conf  |本地测试的 URL 转发规则配置文件| 本地模拟测试使用|
|smarty.conf     |本地测试的 Smarty 引擎的配置文件，common 模块包含即可|本地模拟测试使用|
|fis-conf.js     |fis3 的配置文件| fis3 构建工具使用 |

*以上目录文件不是都必须需要，一般都会包含page、widget俩目录*

可能从目录结构文件中有一半是提供给本地模拟环境的，所以请不要跟上线文件**搞混**

说完了构造的目录结构，我们开始构造一个应用。

*common*
```
/fis-conf.js
/page/layout.tpl
/plugin
/server.conf
/smarty.conf
/static/layout.less
/static/mod.js
/static/reset.css
/widget/footer
/widget/header
```
- `common/plugin` 一些 FIS 提供的 Smarty 插件或者你自定义的一些 Smarty 插件，可以在[此处下载](https://github.com/fex-team/fis-plus-smarty-plugin)
- `mod.js` FIS 提供的轻量级 JS 模块化框架，简单易用，后续会有章节介绍，你可以在 [/fex-team/mod](https://github.com/fex-team/mod) 找到它

*subsiteA*
```
/fis-conf.js
/page/index.tpl
/server.conf
/test/page/index.php
/widget/post-list
/widget/post-list-item
```

*subsiteB*
```
/fis-conf.js
/page/index.tpl
/server.conf
/test/page/index.php
/widget/post
```

**例子下载** [site.zip](https://github.com/fex-team/fis3-smarty/blob/master/doc/demo/size.zip?raw=true)

### 构建

假定你已经看过 FIS3 的相关文档（http://fis.baidu.com)。

首先下载 demo，然后解压，进入这个目录，执行以下命令对所有模块进行构建发布。

```
fis3 release -r common
fis3 release -r subsiteA
fis3 release -r subsiteB
```

可能有人会问，能否一条命令就构建三个模块，在此处明确说明这是不能的，至少暂时不支持。

### 预览

首先保证你安装了本地**测试模拟环境**套件，如果你忘了安装，按照一下命令安装。

```
fis3 server install server-env
```

启动本地测试服务进行预览，本地测试服务依赖

- java >= 1.6.0
- php-cgi >= 5.2.17

> 这块注意，很多 Mac 使用 Homebrew 安装的都不带 php-cgi，需要在安装时指定编译选项
>> `brew install php55 --with-cgi --with-curl`

> Java 安装完以后需要设置环境变量，切记。


执行以下命令启动服务

```
fis3 server start --type php --rewrite
```

执行成功的话，会打开你的默认浏览器并得出 Demo 的运行结果。

![](./img/home.png)

> 可能看上去简陋了一点，但说明问题就行了，美化的事情就交给专业前端同学吧，我半路出家的就不瞎搞了。

### 打包

合并静态资源是前端构建工具的基本能力，所以此处介绍一下 smarty 解决方案里面如何打包。**再次强调，默认情况下不需要安装任何打包相关的插件**。

如 http://fis.baidu.com 介绍，给文件分配 `packTo` 属性即可完成打包。

```js
fis.match('*.css', {
    packTo: '/static/aio.css'
});

fis.match('*.less', {
    packTo: '/static/aio.css'
});
```

解释一下；

第一个 `fis.match` 给所有的 `.css` 文件分配了属性 `packTo` 值为 `/static/aio.css`，意思是所有的 `.css` 文件讲被合并到 `/static/aio.css` 文件中。

第二个 `fis.match` 同样给所有的 `.less` 文件分配属性 `packTo` 同样值跟第一个 `fis.match` 的 `packTo` 是相同的，意思是将所有的 `.less` 文件也打包到 `/static/aio.css` 文件中。由于 `.less` 在 `parser` 阶段就预编译为 `css` 文件了，所以可以这么做。

这样，就把 `.less` 和 `.css` 文件合并到了文件 `/static/aio.css`；当然以上配置等价于

```js
fis.match('*.{css,less}', {
    packTo: '/static/aio.css'
});
```
- 关于 `fis.match` 请具体参考文档 http://fis.baidu.com/fis3/docs/api/config-api.html#fis.match()

可能看到此处，有人会疑惑，当多个文件打包到**同一个打包文件**时顺序如何调整？

关于顺序，在 FIS 中可以通过 `@require` 来做调整，比如

```
/static/m.css
/static/a.css
```

m.css 必须在 a.css 之前，那么在 a.css 书写依赖 m.css 即可。

```css
/* @require ./m.css */
.a {

}
```

当然有些人觉着上面这种方式太麻烦了，所以我们提供了 `packOrder` 属性来做一些顺序调整；

```js
fis.match('a.css', {
    packOrder: -1,
    packTo: '/static/pkg.css'
});

fis.match('m.css', {
    packOrder: -2,
    packTo: '/static/pkg.css'
})
```

`packOrder` 的值越小越靠前，默认值为 `0`

- `packOrder` 请参考文档 http://fis.baidu.com/fis3/docs/api/config-props.html#packOrder

有些人可能还不太习惯这种打包方式，特别是 fis-plus 转过来的同学，不过你慢慢就会喜欢上此种方式的。由于配置是 js 的，所以可以发挥你的想象力，按照你想要的方式定制配置接口。


### 静态资源添加CDN

其实添加 CDN 在 FIS 里面只是**资源定位**的一小块功能，但考虑到比较常用就单拎出来说明；

添加 CDN 说白了就是在所有静态资源 URL 前面加上一个 CDN 的域名，具体 CDN 是什么可能需要你 Google 或者 百度 一下。

在 FIS3 中添加这个 CDN 域名很简单，只需要给文件分配 `domain` 属性即可。

```js
fis.match ('*.js', {
    domain: 'http://cdn.baidu.com/v0'
});
```

这样所有 js 文件引用的 url 都会在前面加上这样一个域名。

#### 扩展阅读

当然这个功能同样适用于那些需要后端同学传一个 `$base_url` 的场景；

```php
<script src="<?=$base_url?>/static/a.js"></script>
```

这样就导致 FIS 在编译的时候找不到 `a.js` 并无法替换 url。

**解决办法**如下：

开发时只需要

```html
<script src="/static/a.js"></script>
```

最后通过 domain 配置具体的 `$base_url`

```js
fis.match('*.js', {
    domain: '/public' // 如果 $base_url == /public
});
```