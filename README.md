## fis3-smarty

基于 FIS3 的针对 Smarty 模板的前端工程解决方案

### 使用方法

**安装**

```
npm install -g fis3
```

**配置使用**
```js
// vi fis-conf.js

require('fis3-smarty')(fis)
fis.set('namespace', <namespace>)
```
- `<namespace>` 当前模块唯一名字

### 本地测试服务

**安装本地模拟环境**

```bash
fis3 server install server-env
```

**启动服务**

```bash
fis3 server start --type php --rewrite
```

