
        !(function(){
            const win = window;
            const _baseFontSize = 100;
            const _fontscale = 1;
            const doc = win.document;
            var clientWidth = doc.documentElement.clientWidth;
            const ua = navigator.userAgent;
            const matches = ua.match(/Android[\S\s]+AppleWebkit\/(\d{3})/i);
            const UCversion = ua.match(/U3\/((\d+|\.){5,})/i);
            const isUCHd = UCversion && parseInt(UCversion[1].split('.').join(''), 10) >= 80;
            const isIos = navigator.appVersion.match(/(iphone|ipad|ipod)/gi);
            let dpr = win.devicePixelRatio || 1;
            if (!isIos && !(matches && matches[1] > 534) && !isUCHd) {
            // 如果非iOS, 非Android4.3以上, 非UC内核, 就不执行高清, dpr设为1;
            dpr = 1;
            }
            // const scale = 1 / dpr;
            let scale = clientWidth / 750 * 2 ;
        
            let fontSize = 16 * scale; //rem基础值
            if (scale > 1) {
                scale = 1;
            }
            let metaEl = doc.querySelector('meta[name="viewport"]');
            if (!metaEl) {
            metaEl = doc.createElement('meta');
            metaEl.setAttribute('name', 'viewport');
            doc.head.appendChild(metaEl);
            }
            console.log(metaEl.setAttribute('content',
            `width=device-width,user-scalable=no,initial-scale=${scale},maximum-scale=${scale},minimum-scale=${scale}`));
            doc.documentElement.style.fontSize = `${fontSize}px`;
        })()