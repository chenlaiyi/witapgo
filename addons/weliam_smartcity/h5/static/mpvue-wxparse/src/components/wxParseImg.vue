<template>
	<view class="wxParse-img-box">
		<view class="show-image p-r" v-if="!isWidth" :style="{'background-image':'url('+node.attr.src+')','width':imageWidth+'px','height':imageHeight+'px'}">
			<view class="image-load" v-if="isLoad"></view>
		</view>
		<image class="select-image" :mode="node.attr.mode" :lazy-load="node.attr.lazyLoad" :class="node.classStr + [isWidth?' select-image-show':'']"
		 :style="newStyleStr || node.styleStr" :data-src="node.attr.src" :src="node.attr.src" @tap="wxParseImgTap" @load="wxParseImgLoad" />
	</view>

</template>

<script>
	export default {
		name: 'wxParseImg',
		data() {
			return {
				imageHeight: "",
				imageWidth: "",
				newStyleStr: '',
				preview: true,
				isLoad: true,
				isWidth: false,
				wxParseWidth: {
					value: 0
				}
			};
		},
		// inject: ['parseWidth'],
		props: {
			node: {
				type: Object,
				default () {
					return {};
				}
			}
		},
		methods: {
			wxParseImgTap(e) {
				// if (!this.preview) return;
				// const {
				// 	src
				// } = e.currentTarget.dataset;
				// if (!src) return;
				// let parent = this.$parent;
				// while (!parent.preview || typeof parent.preview !== 'function') {
				// 	// TODO 遍历获取父节点执行方法
				// 	parent = parent.$parent;
				// }
				// parent.preview(src, e);
			},
			// 图片视觉宽高计算函数区
			wxParseImgLoad(e) {
				let _this = this;
				const {
					src
				} = e.currentTarget.dataset;
				if (!src) return;
				let {
					width,
					height
				} = e.mp.detail;

				const recal = this.wxAutoImageCal(width, height);

				const {
					imageheight,
					imageWidth
				} = recal;
				const {
					padding,
					mode
				} = this.node.attr; //删除padding
				// const { mode } = this.node.attr;
				const {
					styleStr
				} = this.node;

				const imageHeightStyle = mode === 'widthFix' ? '' : "";
				this.newStyleStr = `${styleStr}; ${imageHeightStyle}; padding: 0 ${padding}px;`; //删除padding
				// this.newStyleStr = `${styleStr}; ${imageHeightStyle}; width: ${imageWidth}px;`;
				//延时获取图片渲染后时间宽度
				const query = uni.createSelectorQuery().in(_this);
				query.select('.show-image').boundingClientRect(data => {
					if (data.width === 0) {
						_this.isWidth = true;
					} else {
						_this.imageWidth = data.width;
						_this.imageHeight = data.width * (imageheight / imageWidth);
					}
					_this.isLoad = false;
				}).exec();
			},
			// 计算视觉优先的图片宽高
			wxAutoImageCal(originalWidth, originalHeight) {
				// 获取图片的原始长宽
				const windowWidth = this.$store.state.parseWidth;
				const results = {};
				if (originalWidth < 60 || originalHeight < 60) {
					const {
						src
					} = this.node.attr;
					let parent = this.$parent;
					while (!parent.preview || typeof parent.preview !== 'function') {
						parent = parent.$parent;
					}
					parent.removeImageUrl(src);
					this.preview = false;
				}

				// 判断按照那种方式进行缩放
				if (originalWidth > windowWidth) {
					// 在图片width大于手机屏幕width时候
					results.imageWidth = windowWidth;
					results.imageheight = windowWidth * (originalHeight / originalWidth);
				} else {
					// 否则展示原来的数据
					results.imageWidth = originalWidth;
					results.imageheight = originalHeight;
				}
				return results;
			}
		}
	};
</script>
<style>
	.show-image {
		width: 100%;
		background-size: 100% 100%;
		background-repeat: no-repeat;
	}

	.select-image {
		display: none !important;
	}

	.select-image-show {
		display: inline-block !important;
	}

	.wxParse-img-box {
		width: 100%;
		max-width: 100%;
	}

	.image-load {
		position: absolute;
		top: 50%;
		left: 50%;
		margin: -15upx 0 0 -15upx;
		width: 30upx;
		height: 30upx;
		display: inline-block;
		padding: 0px;
		border-radius: 100%;
		border: 2upx solid;
		border-top-color: #FFD940;
		border-bottom-color: rgba(0, 0, 0, 0.1);
		border-left-color: #FFD940;
		border-right-color: rgba(0, 0, 0, 0.1);
		animation: loader 1s ease-in-out infinite;
	}

	@keyframes loader {
		from {
			transform: rotate(0deg);
		}

		to {
			transform: rotate(360deg);
		}
	}
</style>
