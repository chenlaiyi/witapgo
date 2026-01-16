(function ($) {
    'use strict';

    $.extend($.fn.bootstrapTable.defaults, {
        fixedColumns: false,
        fixedNumber: 1
    });

    var BootstrapTable = $.fn.bootstrapTable.Constructor,
        _initHeader = BootstrapTable.prototype.initHeader,
        _initBody = BootstrapTable.prototype.initBody,
        _resetView = BootstrapTable.prototype.resetView;

    BootstrapTable.prototype.initFixedColumns = function () {
        this.$fixedHeader = $([
            '<div class="fixed-table-header-columns">',
            '<table>',
            '<thead></thead>',
            '</table>',
            '</div>'].join(''));

        this.timeoutHeaderColumns_ = 0;
        this.$fixedHeader.find('table').attr('class', this.$el.attr('class'));
        this.$fixedHeaderColumns = this.$fixedHeader.find('thead');
        this.$tableHeader.before(this.$fixedHeader);

        this.$fixedBody = $([
            '<div class="fixed-table-body-columns">',
            '<table>',
            '<tbody></tbody>',
            '</table>',
            '</div>'].join(''));

        this.timeoutBodyColumns_ = 0;
        this.$fixedBody.find('table').attr('class', this.$el.attr('class'));
        this.$fixedBodyColumns = this.$fixedBody.find('tbody');
        this.$tableBody.before(this.$fixedBody);
    };

    BootstrapTable.prototype.initHeader = function () {
        _initHeader.apply(this, Array.prototype.slice.apply(arguments));

        if (!this.options.fixedColumns) {
            return;
        }

        this.initFixedColumns();

        var $tr = this.$header.find('tr:eq(0)').clone(),
            $ths = $tr.clone().find('th');

        $tr.html('');
        for (var i = 0; i < this.options.fixedNumber; i++) {
            $tr.append($ths.eq($ths.length - this.options.fixedNumber + i).clone());
        }
        this.$fixedHeaderColumns.html('').append($tr);

    };

    BootstrapTable.prototype.initBody = function () {
        _initBody.apply(this, Array.prototype.slice.apply(arguments));

        if (!this.options.fixedColumns) {
            return;
        }

        var that = this,
            rowspan = 0;

        this.$fixedBodyColumns.html('');
        this.$body.find('> tr[data-index]').each(function () {
            var $tr = $(this).clone(),
                $tds = $tr.clone().find('td');

            $tr.html('');
            for (var i = 0; i < that.options.fixedNumber; i++) {
                var indexTd = $tds.length - that.options.fixedNumber + i;
                var oldTd = $tds.eq(indexTd);
                var fixTd = oldTd.clone();
                var buttons = fixTd.find('button');
                //事件转移：冻结列里面的事件转移到实际按钮的事件
                buttons.each(function (key, item) {
                    that.$body.find("tr[data-index=" + $tr.attr('data-index') + "] td:eq(" + indexTd + ") button:eq(" + key + ")").children('.glyphicon').css("position", "static");
                    $(item).click(function () {
                        that.$body.find("tr[data-index=" + $tr.attr('data-index') + "] td:eq(" + indexTd + ") button:eq(" + key + ")").click();
                    });
                });
                $tr.append(fixTd);
                $('#tb_bandlist').bootstrapTable('resetView');
            }
            that.$fixedBodyColumns.append($tr);
        });
    };

    BootstrapTable.prototype.resetView = function () {
        _resetView.apply(this, Array.prototype.slice.apply(arguments));

        if (!this.options.fixedColumns) {
            return;
        }

        clearTimeout(this.timeoutHeaderColumns_);
        this.timeoutHeaderColumns_ = setTimeout($.proxy(this.fitHeaderColumns, this), this.$el.is(':hidden') ? 100 : 0);

        clearTimeout(this.timeoutBodyColumns_);
        this.timeoutBodyColumns_ = setTimeout($.proxy(this.fitBodyColumns, this), this.$el.is(':hidden') ? 100 : 0);
    };

    BootstrapTable.prototype.fitHeaderColumns = function () {
        var that = this,
            visibleFields = this.getVisibleFields(),
            headerWidth = 0;

        this.$body.find('tr:first-child:not(.no-records-found) > *').each(function (i) {
            var $this = $(this),
                index = i;

            if (i >= visibleFields.length - that.options.fixedNumber) {
                that.$fixedHeader.find('th[data-field="' + visibleFields[index] + '"]')
                    .find('.fht-cell').width($this.innerWidth() - 1);
                headerWidth += $this.outerWidth();
            }
        });
        this.$fixedHeader.width(headerWidth - 1).show();
    };

    BootstrapTable.prototype.fitBodyColumns = function () {
        var that = this,
            top = -(parseInt(this.$el.css('margin-top'))),
            height = this.$tableBody.height() - 18;

        if (!this.$body.find('> tr[data-index]').length) {
            this.$fixedBody.hide();
            return;
        }


        if (!this.options.height) {
            top = this.$fixedHeader.height() - 1;
            height = height - top;
        }

        if (IsPC()) {
            if (this.$body.find('> tr[data-index]').length > 10) {
                this.$fixedHeader.css
                ({
                    right: 17
                }).show();
                this.$fixedBody.css({
                    width: this.$fixedHeader.width(),
                    height: height,
                    top: top + 1,
                    right: 17
                }).show();
            }
            else {
                this.$fixedBody.css({
                    width: this.$fixedHeader.width(),
                    height: height,
                    top: top + 1,
                    right: 0
                }).show();
            }
        }
        else {
            this.$fixedBody.css({
                width: this.$fixedHeader.width(),
                height: height + 18,
                top: top + 1,
                right: -1
            }).show();
        }


        this.$body.find('> tr').each(function (i) {
            that.$fixedBody.find('tbody tr:eq(' + i + ')').height($(this).height());
        });

        //// events
        this.$tableBody.on('scroll', function () {
            that.$fixedBody.find('table').css('top', -$(this).scrollTop());
        });
        this.$body.find('> tr[data-index]').off('hover').hover(function () {
            var index = $(this).data('index');
            that.$fixedBody.find('tr[data-index="' + index + '"]').addClass('hover');
        }, function () {
            var index = $(this).data('index');
            that.$fixedBody.find('tr[data-index="' + index + '"]').removeClass('hover');
        });
        this.$fixedBody.find('tr[data-index]').off('hover').hover(function () {
            var index = $(this).data('index');
            that.$body.find('tr[data-index="' + index + '"]').addClass('hover');
        }, function () {
            var index = $(this).data('index');
            that.$body.find('> tr[data-index="' + index + '"]').removeClass('hover');
        });
    };

})(jQuery);