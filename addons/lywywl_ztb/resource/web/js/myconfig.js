var version = +new Date();
var myconfig = {
    path: '../addons/lywywl_ztb/resource/',
    alias: {
        'select2': 'plugin/select2/select2.full.min',
        'bootstrap-table': 'plugin/bootstrap-table/bootstrap-table',
        'bootstrap-table-zh-cn': 'plugin/bootstrap-table/locale/bootstrap-table-zh-CN',
        'bootstrap-table-editable': 'plugin/bootstrap-table/extensions/editable/bootstrap-table-editable',
        'bootstrap-editable': 'plugin/bootstrap3-editable/js/bootstrap-editable',
        'bootstrap-switch': 'plugin/bootstrap-switch/bootstrap-switch',
        'validform': 'plugin/validform/5.3.2/Validform_v5.3.2_min',
        'icheck': 'plugin/iCheck/icheck.min',
        'bootstrap-slider': 'plugin/bootstrap-slider/bootstrap-slider',
        'arttemplate': 'plugin/artTemplate/template-native-debug',
        'bootstrap-table-fixed-columns': 'plugin/fixed-columns/js/bootstrap-table-fixed-columns',
        'clipboard': 'plugin/clipboard/clipboard.min',
        'chartjs': 'plugin/chartjs/Chart.min',
        'dropload': 'plugin/dropload/dropload',
        'tagsinput': 'plugin/tagsinput/jquery.tagsinput-revisited'
    },
    map: {
        'js': '.js?v=' + version,
        'css': '.css?v=' + version
    },
    css: {
        'select2': 'plugin/select2/select2.min',
        'bootstrap-table': 'plugin/bootstrap-table/bootstrap-table',
        'bootstrap-editable': 'plugin/bootstrap3-editable/css/bootstrap-editable',
        'bootstrap-switch': 'plugin/bootstrap-switch/bootstrap-switch',
        'validform': 'plugin/validform/5.3.2/Validform',
        'icheck': 'plugin/iCheck/all',
        'bootstrap-slider': 'plugin/bootstrap-slider/slider',
        'bootstrap-table-fixed-columns': 'plugin/fixed-columns/css/bootstrap-table-fixed-columns',
        'dropload': 'plugin/dropload/dropload',
        'tagsinput': 'plugin/tagsinput/jquery.tagsinput-revisited'
    }
    , preload: ['jquery']

};

var myrequire = function (arr, callback) {
    var newarr = [];
    $.each(arr, function () {
        var js = this;

        if (myconfig.css[js]) {
            var css = myconfig.css[js].split(',');
            $.each(css, function () {
                if(typeof myrequire.systemVersion !== 'undefined'){
                    if (myrequire.systemVersion === '1.0.0' || myrequire.systemVersion <= '0.8')
                    {
                        newarr.push("css!" + myconfig.path + this + myconfig.map['css']);
                    }
                    else
                    {
                        newarr.push("loadcss!" + myconfig.path + this + myconfig.map['css']);
                    }
                }else{
                    newarr.push("css!" + myconfig.path + this + myconfig.map['css']);
                }
            });


        }

        var jsitem = this;
        if (myconfig.alias[js]) {
            jsitem = myconfig.alias[js];

        }
        newarr.push(myconfig.path + jsitem + myconfig.map['js']);
    });
    require(newarr, callback);
}
