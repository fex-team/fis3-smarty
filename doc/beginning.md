## 起步

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
|widget| 放一些 widget 我们暂定叫它组件|逻辑代码，最终上线|
|page|   放一些页面，子站可能有多个页面|逻辑代码，最终上线|
|plugin| 有一些 Smarty 的插件放入这个目录，当然一般只需要一个模块拥有即可，比如 common|逻辑代码，最终上线|
|static|非组件静态资源|逻辑代码，最终上线|
|test|   测试数据，放一些模拟数据|本地模拟测试使用|
|server.conf  |本地测试的 URL 转发规则配置文件| 本地模拟测试使用|
|smarty.conf     |本地测试的 Smarty 引擎的配置文件|本地模拟测试使用|
|fis-conf.js     |fis3 的配置文件| fis3 构建工具使用 |

*以上目录文件不是都必须需要，一般都会包含page、widget俩目录*

可能从目录结构文件中有一半是提供给本地模拟环境的，所以请不要跟上线文件**搞混**

说完了构造的目录结构，我们开始构造一个应用。

*common*
```
/common/widget/header
/common/widget/footer
/common/static/mod.js
/common/page/layout.tpl
/common/plugin
```
- `common/plugin` 一些 FIS 提供的 Smarty 插件或者你自定义的一些 Smarty 插件，可以在[此处下载](https://github.com/fex-team/fis-plus-smarty-plugin)
- `mod.js` FIS 提供的轻量级 JS 模块化框架，简单易用，后续会有章节介绍

*subsiteA*
```
/subsiteA/widget/list-item
/subsiteA/page/index.tpl
/subsiteA/page/index.php
```

*subsiteB*
```
/subsiteB/widget/box
/subsiteB/page/index.tpl
/subsiteB/page/index.php
```
