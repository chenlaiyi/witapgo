<?php
defined('IN_IA') or exit('Access Denied');

class TapgoModule extends WeModule {
    public function doWebAdmin() {
        global $_W, $_GPC;

        // 处理表单提交
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_GPC['data'];

            // 数据验证
            if (!empty($data)) {
                // 插入数据到数据库
                $result = pdo_insert('tapgo_data', array('data' => $data, 'created_at' => time()));
                if ($result) {
                    echo "数据保存成功！";
                } else {
                    echo "数据保存失败！";
                }
            } else {
                echo "数据不能为空！";
            }
        }

        // 加载模板
        include $this->template('admin');
    }

    public function doWebInstitutionCenter() {
        global $_W, $_GPC;

        // 调试输出
        echo "进入机构管理中心"; // 添加这一行

        // 获取机构ID
        $institution_id = $_GPC['institution_id'];

        // 查询机构信息
        $institution = pdo_get('ddg_institution', array('id' => $institution_id));

        // 检查机构是否存在
        if (!$institution) {
            echo "机构不存在！";
            return;
        }

        // 加载模板
        include $this->template('institution_center');
    }

    public function settingsDisplay($settings) {
        global $_W, $_GPC;

        // 添加菜单项
        $menu = array(
            '机构管理中心' => 'doWebInstitutionCenter',
        );

        // 渲染菜单
        include $this->template('settings');
    }

    public function doWebPluginManager() {
        global $_W, $_GPC;

        // 检查用户权限
        if (!user_has_permission('manage_plugins')) {
            echo "无权限访问插件管理";
            return;
        }

        // 加载插件列表
        $plugins = $this->getAvailablePlugins();

        // 渲染插件管理界面
        include $this->template('plugin_manager');
    }

    private function getAvailablePlugins() {
        // 获取可用插件列表的逻辑
        return array(
            // 示例插件列表
            array('name' => '插件1', 'status' => '启用'),
            array('name' => '插件2', 'status' => '禁用'),
        );
    }
}