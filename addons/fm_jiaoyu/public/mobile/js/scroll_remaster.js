/*上拉到底部 加载更多
limit 当前 查询条目的下标 默认从0开始
pageSize 每次查询的增加条目数
ajax_switch 表示 ajax 锁，防止多次提交
ul_box 包含条目的容器的 class
li_item 单位条目的 标签的 class
ajax_url ajax的url
调用方法如下：
new Scroll_load({
    'limit': '0',
    'pageSize': 10,
    'ajax_switch': true,
    'ul_box': '.baby_diary_list',
    'li_item': '.baby_diary_list .li_content_box',
    "param": ["ctype"], //需要额外传递的限制数据
    'ajax_url': '@Url.Action("NotifyList")',
    'page_name': 'parent_notify', //  页面名称,仅当启用缓存时有用
    'after_ajax': function () {
    }
}).load_init();
*/

var index_type_item = "";
function scroll_list_to_detail() {
    sessionStorage.setItem(
        "cache_html_switch_" + scroll_load_obj.page_name,
        true
    );
}

function Scroll_load(param, ScrollDiv) {
    this.ScrollDiv = ScrollDiv || document;
    this.viewWindow = ScrollDiv || window;
    this.limit = $(ScrollDiv)
        .find(self.ul_box)
        .find(param.li_item)
        .eq($(ScrollDiv).find(self.ul_box).find(param.li_item).length - 1)
        .attr("time");
    this.pageSize = param.pageSize || 10;
    this.param = param.param;
    this.ajax_switch = param.ajax_switch || true;
    this.ul_box = param.ul_box || ".listContent";
    this.noticeytpe = param.noticeytpe || "";
    this.li_item = param.li_item || ".listContent .leave_main";
    this.ajax_url = param.ajax_url || "";
    this.bj_id = param.bj_id || "";
    this.after_ajax = param.after_ajax || null;
    this.page_name = param.page_name || "";
}

Scroll_load.prototype.load_init = function () {
    let self = this;
    let TrueUl = self.ul_box;
    if ($(self.ScrollDiv).find(".scroll-tips").length == 0) {
        $(self.ScrollDiv)
            .find(TrueUl)
            .after(
                ' <div class="scroll-tips" style="width: 100%;height: 50px;display:none;overflow:hidden" > <div style="color:gray;margin:0 auto;width: 150px;text-align: center;line-height:50px" class="scroll-tips-word"> 更多数据加载中... </div> </div>'
            );
    }

    //判断时候有缓存的hmtl，有的话加到列表容器
    //if (sessionStorage.getItem('cache_html_switch_' + self.page_name) && sessionStorage.getItem('cache_html' + self.page_name)) {
    //    $(self.ul_box).html(sessionStorage.getItem('cache_html' + self.page_name));
    //    if (typeof (self.after_ajax) != 'undefined') { self.after_ajax(); }
    //    //判断时候有 缓存的 scroll_top，有的话滚动到相应的高度
    //    if (sessionStorage.getItem('scroll_top' + self.page_name)) {
    //        $(window).scrollTop(sessionStorage.getItem('scroll_top' + self.page_name));
    //    }
    //}
    //else {
    //    clear_page_session(this.page_name);
    //}
    //sessionStorage.removeItem('cache_html_switch_' + self.page_name);
    if (
        $(self.ScrollDiv).find(self.ul_box).find(self.li_item).length %
            self.pageSize !=
            0 ||
        $(self.ScrollDiv).find(self.ul_box).find(self.li_item).length == 0
    ) {
        $(".jzz_text").text(""); //数据已加载完毕
    }
    $(this.viewWindow).on("scroll", { obj: self }, scroll_fun);
};

Scroll_load.prototype.reset_ajax = function () {
    let self = this;
    this.ajax_switch = true;
 /*          if (sessionStorage.getItem('scroll_top' + self.page_name)) {
           $(self.viewWindow).scrollTop(sessionStorage.getItem('scroll_top' + self.page_name));
       } */
};

function scroll_fun(_event) {
    let _obj = _event.data.obj;
    let winHeight = $(_obj.viewWindow).innerHeight(),
        scrollTop = $(_obj.ScrollDiv).scrollTop(),
        documentHeight = $(_obj.ScrollDiv)[0].scrollHeight || $(_obj.ScrollDiv).height();
    // var bottom = $(".has_show_over");
    // var winHeight = window.innerHeight || document.documentElement.clientHeight,
    //     scrollTop = document.body.scrollTop || document.documentElement.scrollTop,
    //     documentHeight = $(document).height();

   /*  // 将当前的浏览器滚动的高度存在浏览器缓存变量scroll_top
    sessionStorage.setItem("scroll_top" + _obj.page_name, scrollTop); */
    //判断是否滚到差不多浏览器底部
    if (
        parseInt(winHeight) + parseInt(scrollTop) + 5 >
        parseInt(documentHeight)
    ) {
        let self = _obj;

        $(self.viewWindow).off("scroll", scroll_fun);

        if (self.ajax_switch) {
            self.ajax_switch = false; //把ajax锁关了防止不断ajax

            let TrueUl = self.ul_box;
            let datanumb = $(self.ScrollDiv).find(TrueUl).children(self.li_item)
                .length;
            if (datanumb >= 1) {
                $(self.ScrollDiv).find(".scroll-tips").css("height", "50px");
                $(self.ScrollDiv).find(".scroll-tips").show();
                $(self.ScrollDiv)
                    .find(".scroll-tips-word")
                    .text("更多数据加载中...");
            }
            let search_type = ""; //搜索条件
            let search_content = "";
            if ($("#search_input").length > 0) {
                typesearch_content = $.trim($("#search_input").val());
                $(".type_item.checked").each(function () {
                    if (search_type != "") {
                        search_type += "," + $(this).attr("type");
                    } else {
                        search_type += $(this).attr("type");
                    }
                });
            }
            if (index_type_item != "") {
                search_type = index_type_item;
            }

            var GetLiData = {};

            for (let item of self.param) {
                GetLiData[item] =
                    $(self.ScrollDiv)
                        .find(TrueUl)
                        .children(`${self.li_item}`)
                        .eq($(self.ScrollDiv) .find(TrueUl) .children(`${self.li_item}`).length - 1 )
                        .attr(`${item}`) || -1;
            }
            // this.LiData = GetLiData;
            var post_data = {
                limit: $(self.ScrollDiv)
                    .find(TrueUl)
                    .children(self.li_item)
                    .eq( $(self.ScrollDiv).find(TrueUl).children(self.li_item) .length - 1 )
                    .attr("time"),
                type: search_type,
                ExtraData: GetLiData,
                content: search_content,
            };

            $.ajax({
                type: "POST",
                url: self.ajax_url,
                data: post_data,
                dataType: "html",
                success: function (data) {
                    //载入更多内容
                    if ($.trim(data)) {
                        $(self.ScrollDiv).find(TrueUl).append(data);
                        // sessionStorage.setItem('cache_html' + self.page_name, $(self.ul_box).html());
                        //self.limit = $(self.ul_box).children('li').eq($(self.ul_box).children('li').length-1).attr('time');
                        // sessionStorage.setItem('limit' + self.page_name, self.limit);
                        if (typeof self.after_ajax != "undefined") {
                            self.after_ajax();
                        }
                        $(self.viewWindow).on(
                            "scroll",
                            { obj: self },
                            scroll_fun
                        );
                        self.ajax_switch = true;
                    } else {
                        $(self.ScrollDiv)
                            .find(".scroll-tips")
                            .css("height", "50px");
                        $(self.ScrollDiv).find(".scroll-tips").show();
                        $(self.ScrollDiv)
                            .find(".scroll-tips-word")
                            .text("数据已加载完毕");
                        setTimeout(() => {
                            $(self.ScrollDiv)
                                .find(".scroll-tips")
                                .animate({ height: "0" });
                        }, 500);
                        // $(self.viewWindow).off("scroll", scroll_fun);
                    }
                },
                error: function () {
                    jTips("加载失败！");
                    $(self.viewWindow).on("scroll", { obj: self }, scroll_fun);
                    self.ajax_switch = true;
                },
            }); //ajax结束
        }
    }
}
