## fis3-smarty

基于 FIS3 的针对 Smarty 模板的前端工程解决方案

### 文档

- Smarty 插件、XSS 自动修复、本地测试服务、上线指导等文档参见 [/doc/README.md](doc/README.md)
- 构建工具文档参见 https://github.com/fex-team/fis3

### 使用方法

**安装**

```
npm install -g fis3
npm install -g fis3-smarty
```

**mod.js**

mod.js 更新到最新，下载地址 [fex-team/mod](https://github.com/fex-team/mod)

**配置使用**
```js
// vi fis-conf.js

fis.require('smarty')(fis);
fis.set('namespace', <namespace>);

// default media is `dev`，
fis.media('dev').match('*', {
    useHash: false,
    optimizer: null
});

```
- `<namespace>` 当前模块唯一名字
- `fis3 release` 执行时关闭 **md5**、**压缩**

### 本地测试服务

**安装本地模拟环境**
* fis3 >= 3.2.6
    
    ```bash
    # 命令行在 fis3-smarty 的项目目录。
    fis3 server start
    
    # 不在 fis3-smarty 项目目录
    npm install -g fis3-server-smarty
    fis3 server start --type smarty
    ```
* fis3 < 3.2.6

    ```bash
    fis3 server install server-env
    ```
    
    **启动服务**
    
    ```bash
    fis3 server start --type php --rewrite
    ```


## 脚手架

```bash
;  快速启动一个项目
mkdir demo
cd demo
fis3 init php-smarty
```
