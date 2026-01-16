/*
 * @Discription:  过滤文字
 * @Author: Hannibal·Lee
 * @Date: 2020-04-22 14:35:06
 * @LastEditTime: 2020-04-22 15:01:21
 */



/*
 * 用法：
 *     new FilterWord({
 *         'inputDom':'#keywords',       //源文字DOM，必须
 *         'actDom':'.StuLine',          //要操作的DOM，必须
 *         'txtDom':'.StuLine',          //用来过滤的文字的DOM，必须
 *         'isSlide':false,         //是否滑动隐藏/显示，非必须 默认false
 *         'animationTime':150,   //滑动隐藏/显示时间，非必须，仅当 isSlide === true 时有效 默认 150
 *         'isClickFirst':false,    //是否默认点击第一个，非必须 默认false
 *     }).filter_init([function(){}])
*/
//若 filter_init 传递的function 为已声明的function [FuncName],需如下使用：

/* 用法：
 *
 *      function FuncName(){
 *          //Do something...
 *      }
 *
 *      new FilterWord({
 *          'inputDom':'#keywords',       //源文字DOM，必须
 *          'actDom':'.StuLine',          //要操作的DOM，必须
 *          'txtDom':'.StuLine',          //用来过滤的文字的DOM，必须
 *          'isSlide':false,         //是否滑动隐藏/显示，非必须 默认false
 *          'animationTime':150,   //滑动隐藏/显示时间，非必须，仅当 isSlide === true 时有效 默认 150
 *          'isClickFirst':false,    //是否默认点击第一个，非必须 默认false
 *     }).filter_init(FuncName)   //仅需传递FuncName,不要带'()'
*/


function FilterWord(param){
    let paramRequire = ['inputDom','actDom','txtDom']
    this.isSlide =  false;
    this.animationTime =  150;
    this.isClickFirst =  false;
    paramRequire.map( x =>{
        if(param[x] === undefined || param[x] === ''){
            console.error(`FilterWord miss param ${x}`)
        }
    })

   for(let i in param){
    this[i] = param[i]
   }

}

FilterWord.prototype.filter_init = function(callback) {
    let self = this
    $(self.inputDom).bind("input propertychange",function(event){
        let con = !self.isClickFirst ;
        keywords = $(this).val();

        if(typeof(callback) === 'function'){
            callback()
        }
        $(self.actDom).each(function () {
            let s_name = $(this).find(self.txtDom).text();
            let hass_name = s_name.search(keywords);
            if (hass_name == -1) {
                if(self.isSlide === true){
                    $(this).slideUp(self.animationTime);
                }else {
                    $(this).hide();
                }
            } else {
                if(self.isSlide === true){
                    $(this).slideDown(self.animationTime);
                }else {
                    $(this).show();
                }
                    if (con === false) {
                        $(this).click()
                        con = true
                    }
            }
        });
    })
}