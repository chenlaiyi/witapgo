# TapgoTT模块数据库设计文档

---
*分析时间: 2025年6月1日*
*项目路径: /www/wwwroot/w.itapgo.com/addons/cy163_customerservice/*

## 1. 数据库表前缀
所有表使用前缀: ims_tapgo_tt_

## 2. 数据库表结构

## 客服插件配置完成记录

### 2024年12月19日 - 解决问题记录

#### 问题1: "指定公众号已被删除"
**原因**: `ims_account` 表中 `uniacid` 为 31 的记录被标记为已删除 (`isdeleted = 1`)
**解决方案**: 执行 SQL 更新语句
```sql
UPDATE ims_account SET isdeleted = 0 WHERE uniacid = 31;
```

#### 问题2: "平台账号服务已过期"
**原因**: `ims_uni_account` 表中 `uniacid` 为 31 的记录服务已过期 (`endtime` 小于当前时间)
**解决方案**: 执行 SQL 更新语句
```sql
UPDATE ims_uni_account SET endtime = 2147483647 WHERE uniacid = 31;
```

#### 问题3: "功能模块不存在"
**原因**: `ims_uni_modules` 表中缺少 `uniacid` 为 31 且 `module_name` 为 `cy163_customerservice` 的记录
**解决方案**: 执行 SQL 插入语句
```sql
INSERT INTO ims_uni_modules (uniacid, module_name) VALUES (31, 'cy163_customerservice');
```

#### 问题4: "Cy163_customerserviceModuleWebapp Definition File Not Found"
**原因**: 客服插件缺少 `webapp.php` 文件，导致无法处理 webapp 入口请求
**错误信息**: 
```
Warning: Cy163_customerserviceModuleWebapp Definition File Not Found
Fatal error: Call to a member function doPageKefulogin() on null
```
**解决方案**: 创建 `/www/wwwroot/w.itapgo.com/addons/cy163_customerservice/webapp.php` 文件

该文件包含 `Cy163_customerserviceModuleWebapp` 类，实现了以下方法:
- `doPageKefulogin()` - 客服登录页面
- `doPageKefucenter()` - 客服中心页面
- `doPageCustomerchat()` - 客户聊天页面
- `doPageQdadmin()` - 前端管理员页面
- `doPageXcxqdadmin()` - 小程序前端管理员页面
- 其他移动端页面方法

#### 相关数据库表结构
- `ims_account`: 公众号账户信息表
- `ims_uni_account`: 统一账户信息表  
- `ims_uni_account_modules`: 账户模块绑定表
- `ims_uni_modules`: 统一模块表
- `ims_modules`: 模块信息表

#### 客服系统访问地址
- 客服中心: `http://w.itapgo.com/app/index.php?i=31&c=entry&do=kefucenter&m=cy163_customerservice`
- 客服登录: `http://w.itapgo.com/app/index.php?i=31&c=entry&do=kefulogin&m=cy163_customerservice`

**注意**: 如果问题持续存在，可能需要:
1. 检查 URL 参数是否正确
2. 清除系统缓存
3. 检查插件内部路由配置

### 2.1 基础配置表 (ims_tapgo_tt_config)
| 字段名 | 类型 | 说明 |
|--------|------|------|
| id | int(11) | 主键 |
| uniacid | int(11) | 公众号ID |
| key | varchar(50) | 配置键名 |
| value | text | 配置值 |
| created_at | timestamp | 创建时间 |
| updated_at | timestamp | 更新时间 |

### 2.2 用户表 (ims_tapgo_tt_users)
| 字段名 | 类型 | 说明 |
|--------|------|------|
| id | int(11) | 主键 |
| uniacid | int(11) | 公众号ID |
| openid | varchar(50) | 用户openid |
| nickname | varchar(50) | 用户昵称 |
| avatar | varchar(255) | 头像地址 |
| mobile | varchar(20) | 手机号 |
| status | tinyint(1) | 状态 0:禁用 1:正常 |
| created_at | timestamp | 创建时间 |
| updated_at | timestamp | 更新时间 |

### 2.3 订单表 (ims_tapgo_tt_orders)
| 字段名 | 类型 | 说明 |
|--------|------|------|
| id | int(11) | 主键 |
| uniacid | int(11) | 公众号ID |
| order_no | varchar(50) | 订单号 |
| user_id | int(11) | 用户ID |
| amount | decimal(10,2) | 订单金额 |
| status | tinyint(1) | 订单状态 0:待付款 1:已付款 2:已完成 3:已取消 |
| pay_type | varchar(20) | 支付方式 |
| pay_time | timestamp | 支付时间 |
| created_at | timestamp | 创建时间 |
| updated_at | timestamp | 更新时间 |

### 2.4 支付记录表 (ims_tapgo_tt_payments)
| 字段名 | 类型 | 说明 |
|--------|------|------|
| id | int(11) | 主键 |
| uniacid | int(11) | 公众号ID |
| order_id | int(11) | 订单ID |
| transaction_id | varchar(50) | 交易号 |
| amount | decimal(10,2) | 支付金额 |
| status | tinyint(1) | 支付状态 |
| created_at | timestamp | 创建时间 |
| updated_at | timestamp | 更新时间 |