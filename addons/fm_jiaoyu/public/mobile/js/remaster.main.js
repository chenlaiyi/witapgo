/*
 * @Discription:  重制js
 * @Date: 2020-09-24 15:10:38
 * @LastEditTime: 2020-10-09 19:13:25
 */

//  **************************************************
//  ***********        自定义小提示          ***********
//  **************************************************

var remasterGlobalTips, remasterGlobalTipsReload;
/**
 * 显示tips
 * @param {string} text 提示文字
 * @param {number} delayTime 延迟时间，默认1600ms
 * @param {boolean} isAuto 是否自动关闭，为false时 delayTime无效。默认true
 */
function ReTipsShow(text, delayTime, isAuto) {
    let Target = $(".remaster-global-tips");
    if (Target.length === 0) {
        let tipsHtml = '<div class="remaster-global-tips"><span></span></div>';
        $("body").append(tipsHtml);
    }
    if (typeof text !== "string" || text === "" || text === null) {
        text = "提示文字";
    }
    delayTime = delayTime || 1600;
    isAuto = isAuto || true;
    if (remasterGlobalTips !== undefined) {
        clearTimeout(remasterGlobalTips);
    }
    if (remasterGlobalTipsReload !== undefined) {
        clearTimeout(remasterGlobalTipsReload);
    }

    if (Target.hasClass("remaster-in-show")) {
        Target.hide().removeClass("remaster-in-show");
    }
    Target.show();

    Target.addClass("reload");
    setTimeout(() => {
        Target.find("span").text(text);
    }, 100);

    remasterGlobalTipsReload = setTimeout(function () {
        Target.addClass("remaster-in-show").removeClass("reload");
    }, 100);
    if (isAuto == true) {
        remasterGlobalTips = setTimeout(function () {
            Target.removeClass("remaster-in-show");
        }, delayTime);
    }
}

/**
 * 关闭tips
 */
function ReTipsClose() {
    $(".remaster-global-tips").removeClass("remaster-in-show");
}

//  **************************************************
//  ***********        自定义确认弹窗        ***********
//  **************************************************
/**
 * 弹窗
 * @param {objec} params 文字设置与是否背景遮罩
 * @param {function} callback 回调函数，传值 true/false
 */
function ReConfirm(params, callback) {
    let oldparams = {
        confirm: "确定?",
        sure: "确定",
        cancel: "取消",
        isBack: true,
    };
    params = Object.assign(oldparams, params);
    if (typeof callback !== "function") {
        console.error("param 2 must be function");
        return false;
    }
    let confirmText = params.confirm || "确定?",
        sureText = params.sure || "确定",
        cancelText = params.cancel || "取消",
        isBack = params.isBack || true;
    if ($(".remaster-confirm-box").length === 0) {
        let bk = isBack ? '<div class="remaster-back remaster-bg"></div>' : "",
            html = `<div class="remaster-confirm-box"> ${bk} <div class="remaster-confirm-content-box "> <div class="remaster-content"> ${confirmText} </div> <div class="remaster-confirm-action-box">  <div class="remaster-confirm-action-cancel">${cancelText}</div><div class="remaster-confirm-action-sure" >${sureText}</div>  </div> </div> </div>`;
        $("body").append(html);
        $(".remaster-confirm-action-sure,.remaster-confirm-action-cancel").off(
            "click"
        );
        $(".remaster-confirm-action-sure").on("click", function () {
            $(".remaster-confirm-box").removeClass("remaster-in-show");
            callback(true);
        });
        $(".remaster-confirm-action-cancel").on("click", function () {
            $(".remaster-confirm-box").removeClass("remaster-in-show");
            callback(false);
        });
    }
    setTimeout(() => {
        $(".remaster-confirm-box").addClass("remaster-in-show");
    }, 100);
}

function addStyle() {
    let style =
        ".remaster-global-tips { z-index: 9999; position: fixed; width: auto; max-width: 300px; height: auto; color: white; padding: 15px; top: 50%; text-align: center; left: 50%; background-color: rgba(0, 0, 0, .43); border-radius: 5px; transform: translate(-50%, -50%) scale(0); overflow: hidden; opacity: 0; transition: opacity 0.1s 0.025s, transform 0.1s cubic-bezier(1, -0.17, 1, 0.13); } .remaster-global-tips.remaster-in-show { opacity: 1; transition: opacity 0.001s cubic-bezier(0.58, 0.08, 1, -0.18), transform 0.125s cubic-bezier(0.04, 0.84, 0.42, 0.76); transform: translate(-50%, -50%) scale(1); } .remaster-global-tips.reload { opacity: 0; transform: translate(-50%, -50%) scale(0.6); transition: opacity 0.01s 0.025s, transform 0.1s cubic-bezier(1, -0.17, 1, 0.13); }.remaster-confirm-box { position: fixed; top: 0; left: 0; height: 0; width: 0; overflow: hidden; z-index: 9998;background-color: rgba(165, 165, 165, .46); transition-delay:  .15s; } .remaster-confirm-box.remaster-in-show{height: 100%;width: 100%; transition-delay:  0.0001s;} .remaster-confirm-box .remaster-back.remaster-bg { position: absolute; top: 0; left: 0; height: 0; width: 0; transition-delay:  0.2s; } .remaster-confirm-box.remaster-in-show .remaster-back.remaster-bg{height: 100%;width: 100%;transition-delay:  0.001s;} .remaster-confirm-box .remaster-confirm-content-box { position: absolute; width: 80%; left: 10%; top: 30%; min-height: 40px; background-color: white; border-radius: 5px; transform:scale(0.5); opacity: 0; transition: opacity 0.1s 0.025s, transform 0.1s cubic-bezier(1, -0.17, 1, 0.13); } .remaster-confirm-box.remaster-in-show .remaster-confirm-content-box{ opacity: 1; transition: opacity 0.001s cubic-bezier(0.58, 0.08, 1, -0.18), transform 0.125s cubic-bezier(0.04, 0.84, 0.42, 0.76); transform:scale(1); } .remaster-confirm-content-box .remaster-content { width: 100%; padding: 20px 10px; text-align: center; } .remaster-confirm-content-box .remaster-confirm-action-box { width: 100%; height: 40px; border-top: 0.5px solid #b1daf7; display: flex; } .remaster-confirm-content-box .remaster-confirm-action-box .remaster-confirm-action-sure { flex: 1;  text-align: center; line-height: 40px; } .remaster-confirm-content-box .remaster-confirm-action-box .remaster-confirm-action-cancel { flex: 1; text-align: center; line-height: 40px; border-right: 1px solid #b1daf7;}";
    $("<style></style>").text(style).appendTo($("head"));
}
window.onload = function () {
    addStyle();
};

//  **************************************************
//  ***********        自定义侧边滑入        ***********
//  **************************************************

// DomData: direction          [ right  |  left | top ] 方向
//          slidewidth         [ half   |  full ] 宽度
//          backgroundclose    [ true   | false ] 点击背景关闭
//          dismissmodalclass    {string  }   默认：close-re-slide      关闭按钮class


$(function () {

    let style=".remaster-slide-box { position: fixed; top: 0; right: 0; width: 0; height: 0; background-color: rgba(202, 202, 202, 0.46); z-index: 999; overflow: hidden; transition-delay: .15s; } .remaster-slide-box.inshow { width: 100%; height: 100vh; transition-delay: .001s; } .remaster-slide-box.right-slide-box .slide-content-box.full { width: 100%; right: -100%; } .remaster-slide-box.left-slide-box .slide-content-box.full { width: 100%; left: -100%; } .remaster-slide-box.top-slide-box .slide-content-box { width: 100%; right: 0; top:-100%; position: absolute; background-color: white; height: auto !important; transition: .15s; } .top-slide-box.inshow .slide-content-box { top: 0 !important; } .right-slide-box .slide-content-box { position: absolute; background-color: white; height: 100%; transition: .15s; width: 50%; right: -50%; } .right-slide-box.inshow .slide-content-box { right: 0 !important; } .left-slide-box .slide-content-box { position: absolute; background-color: white; height: 100%; transition: .15s; width: 50%; left: -50%; } .left-slide-box.inshow .slide-content-box { left: 0 !important; }";
    $("<style></style>").text(style).appendTo($("head"));

    $("*[data-remaster-slide-id]").on("click", function (e) {
        e.preventDefault();
        var modalLocation = $(this).attr("data-remaster-slide-id");
        $("#" + modalLocation).remasterModal($(this).data());
    });

    $.fn.remasterModal = function (options) {
        var defaults = {
            direction: "right",
            slidewidth: "half",
            slidefunc:'',
            backgroundclose: true, //if you click background will modal close?
            dismissmodalclass: "close-re-slide", //the class of a button or element that will close an open modal
        };

        //Extend dem' options
        var options = $.extend({}, defaults, options);

        return this.each(function () {
            /*---------------------------
             Global Variables
            ----------------------------*/
            var modal = $(this);
            modal
                .addClass(options.direction + "-slide-box")
                .find(".slide-content-box")
                .addClass(options.slidewidth);
            if (options.backgroundclose === true) {
                modal.on("click", function () {
                    modal.trigger("re:close");
                });
            }

            modal.find(".slide-content-box").on("click", function () {
                event.stopPropagation();
            });

            /*---------------------------
             Open & Close Animations
            ----------------------------*/
            //Entrance Animations
            modal.on("re:open", function () {
                eval(options.slidefunc)
                modal.addClass("inshow");
                modal.off("re:open");
            });

            //Closing Animation
            modal.on("re:close", function () {
                modal.removeClass("inshow");

                modal.off("re:close");
            });

            /*---------------------------
             Open and add Closing Listeners
            ----------------------------*/
            //Open Modal Immediately
            setTimeout(() => {
                modal.trigger("re:open");
            }, 100);

            //Close Modal Listeners
            var closeButton = $("." + options.dismissmodalclass).on(
                "click",
                function () {
                    modal.trigger("re:close");
                }
            );
        }); //each call
    };
});



//  **************************************************
//  ***********        自定义切换开关        ***********
//  **************************************************

// DomData: sure-color          [ color  |  #4598ec ]
//          cancel-color        [ color  |  #4598ec ]
//          switch-func         [ string |    null  ]
//          inner-text          [ string |    确定   ]
//
//  切换触发：remaster-switch,默认执行 switch-func(this)
//
//


function InitRemasterSwitch(){
    $("remaster-switch").each(function(){
        let defaults = {
            sureColor:'#4598ec',
            cancelColor:'gray',
            switchFunc:'',
            innerText:'确定',
            checkboxName:'',
            checkboxValue:'1'
        }
        let options = $.extend({}, defaults, $(this).data()),
            idItem = $(this).attr("id"),
            style = $(this).attr("style") || '',
            classList = $(this).attr('class') || '',
            idItemHtml = '',
            checkboxHtml = '';


        if(idItem !== undefined){
            idItemHtml = `id="${idItem}"`;
        }

        if(options.checkboxName !== ''){
            checkboxHtml = `<input type="checkbox" value="${options.checkboxValue}" class="cleanBeforeAfter" name="${options.checkboxName}" style="height:0;width:0" >`
        }
        let html = `<div class="remaster-switch-root" style="${style}">
                        <span>${options.innerText}</span>
                        <div ${idItemHtml}  class="remaster-switch ${classList}" onclick="reMasterSwitchCheckFunc(this)" data-func="${options.switchFunc}" style="margin-right: 10px;">
                            <div class="bkg" style="background-color:${options.cancelColor}"> <span class="before" style="background-color:${options.sureColor}"></span> </div>
                            ${checkboxHtml}
                        </div>
                    </div>`;
        $(this).after(html).remove()
    })
}

function reMasterSwitchCheckFunc(e){
    $(e).toggleClass('trued')
    if($(e).data('func') !== null && $(e).data('func') !== ''){
       eval($(e).data('func'));
    }
    $(e).find("input[type='checkbox']").prop("checked",$(e).hasClass("trued"));
    $(e).trigger("remaster-switch",$(e).hasClass("trued"));
}



$(function(){
      let style=" .remaster-switch-root{flex-direction: row-reverse;display: flex;} .remaster-switch，.remaster-switch *{box-sizing: border-box;} .remaster-switch{display: inline-block;width: 40px;height: 20px;border-radius: 10px;position: relative;} .remaster-switch .bkg{position: relative;width: 40px;height: 20px;border-radius: 10px;overflow: hidden;background-color: gray;} .remaster-switch .bkg .before{position: absolute;width: 0;height: 100%;background-color:#4598ec ; top:0;left:0;z-index: 2;transition: width .15s;content:''} .remaster-switch:after{position: absolute;width: 22px;height: 22px;background-color: white;border-radius: 50%;content:'';    border: 1px solid #dedede;top:-2px;left: -2px;z-index: 2;transition: all .15s;} .remaster-switch.trued .bkg .before{width:100%;} .remaster-switch.trued:after{left:calc(100% - 20px); }.cleanBeforeAfter:before,.cleanBeforeAfter:after{width: 0 !important;height: 0 !important;overflow: hidden !important;border:unset !important}";
    $("<style></style>").text(style).appendTo($("head"));
    InitRemasterSwitch()

    $.fn.RemasterSwitchStatus = function(status){
        if(status === true){
            $(this).addClass("trued")
        }else{
            $(this).removeClass("trued")

        }
    }
})


//  **************************************************
//  ***********        自定义折叠面板        ***********
//  **************************************************

// DomData: remaster-collapse-target     折叠对象标识
//          collapse-id                   折叠标识
//          collapse-speed              折叠速度，默认150
//
// icon: collapse-show-icon collapse-icon / collapse-hide-icon collapse-icon 
//
//


// window.onload = function () {
    
// };
let style=`[data-remaster-collapse-target]{position:relative}[data-remaster-collapse-target]:not(.remaster-collapse-show) [collapse-show-icon],[data-remaster-collapse-target].remaster-collapse-show [collapse-hide-icon]{height: 0 !important;width: 0 !important;overflow: hidden !important;}`;
    $("<style></style>").text(style).appendTo($("head"));

$(function(){
   
    $("[data-remaster-collapse-target]").each(function(){
        // $(this).css('position','relative')
        let defaults = {
            remasterCollapseTarget:'',
            collapseSpeed:150
        };
        let  options = $.extend({}, defaults, $(this).data())
       
        $(this).on("click",function(){
            $(this).toggleClass("remaster-collapse-show")

            $(`[data-collapse-id=${options.remasterCollapseTarget}]`).slideToggle(options.collapseSpeed).toggleClass("remaster-collapse-show")
        })
    })
   
})


//  **************************************************
//  ***********        自定义深拷贝函数       ***********
//  **************************************************
// 定义一个深拷贝函数  接收目标target参数
function deepClone(target) {
    // 定义一个变量
    let result;
    // 如果当前需要深拷贝的是一个对象的话
    if (typeof target === 'object') {
    // 如果是一个数组的话
        if (Array.isArray(target)) {
            result = []; // 将result赋值为一个数组，并且执行遍历
            for (let i in target) {
                // 递归克隆数组中的每一项
                result.push(deepClone(target[i]))
            }
         // 判断如果当前的值是null的话；直接赋值为null
        } else if(target===null) {
            result = null;
         // 判断如果当前的值是一个RegExp对象的话，直接赋值    
        } else if(target.constructor===RegExp){
            result = target;
        }else {
         // 否则是普通对象，直接for in循环，递归赋值对象的所有值
            result = {};
            for (let i in target) {
                result[i] = deepClone(target[i]);
            }
        }
     // 如果不是对象的话，就是基本数据类型，那么直接赋值
    } else {
        result = target;
    }
     // 返回最终结果
    return result;
}
