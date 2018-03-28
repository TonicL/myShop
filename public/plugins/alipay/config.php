<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016091000479799",

		//商户私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEA4fSFjXmWI8CU5eCn25PkuoTzRr2jsk6fubwucSJ3m8WFHzU4+y3ZpqCWiQrRJCW48cjZSGnL+P+LubcuJOi+vas2z9AiquFkbYJd4HqwW+lB+mDHjgiV4NVwwCQcvXZZ8hsTk6HkDncnivo5TnjsZmgQC7XTp6P0vJTRwhSaU/ki37XEdB5Mehs+MIiJVerVuSqQCTX7qnUh9jgGezmDHlYgaU3LpK0TAYkCS+T2AcVlW4MojgX/HC5OOQmyTJfVphnmRCyz33Hs0xCqncOP2EPcxe+rAZKC2hnZjHxtif2xYCHQjfG+w4JZCFpU44ZoPz2merzduUD1Rd9B300/1QIDAQABAoIBAQDHIpcpLgTSEYGobqvA6sBkWZOFvtAr7vr52A0eDABZumQuMtu7EpeFMHY65NuY/d3WyOol1Ye8NItR60yxnqWrxt8Rmx9Sdj3p/UD6+2W+Ov64yN5WIN7mPXWXALyLhWiT5KUGMWEqFn01EH282PmO7xtlFqQoVGj2YjnS0BGK+pgkdlRSMp+fhHThtTF5M+mDR3vczD1qKCdSMUFSfAysQoh65mOo5Uts7AaK4Yqg1QMEG0ROSdRYI2hDGACgzyTOTfdshUjNubUIMWlpSDrR5rAZNS9QVi+zxSY7jqFG9HTdsUd1f7yg1JzOdYhNmWhpafYZAFlFpgFYx8rk92qBAoGBAPqvkS8yQ6fL4EPTdhHXAs9JL5jVjUmYvmZmGO/PqKlI+GPv55cTkEXnNVpP1Caft+kO1KiqKUw4rmZSpUVuXp/CIaYtvtnHVDT6mnkn9BBf5zOtoGZO3TgbQlhWoxJy4+fTP6ymKtRU3lJqeYfbcr2HlsXLXdLyAPAzQUpoVeMxAoGBAOa+vsUbGlPBWdVzZI5tNyNmzRPZ0OnIAbz2SHh02PxVQABMsPwBUyzQC0nG3DExbFiUR4/0ZNjSAIdu97PX1Ugpr6jY03gywHoqkn/hyp849LJir8QKL50x74cX4goWbZ7QRW1fG0nG6uHJ3NXGn0Hazp6mCO4wqXNcvNEathXlAoGAcPpvFDYzB4x6phbHP4MHYSQ6r0aPRnvwU3XwByQvfxvD1kZouU2318k74lfX5RBWclKcxObrdc6Vyse0dHYpbxau05YKTVvoN3g55iB7fmW6bS/y+ijQylh+rhFdrRLaY8BxEf5RjyAwkjQqUXA1ZfWVnc7pmgg3JAn1gvNCwgECgYEAw7ksTDjvHfg14Q6eTwlo6ch7T8lEoeibQNOPKU3D+FW/kgF7ZmchTDO0P4JEqB2KD6DHCt585EVNWZPQ3GXJbgqeC5TP23cBOR7/YSX/HwvK071N5fXV6Xq/+FFT1MateTakjV9M4EmwVpFJlrOBxvR4qq2fiZsRQN968cu8g9kCgYEAsDVpo9eeE3QAanByDRcKTr4+MgnUfoM+PHxyhykhyU0wF6OqTD9q7INOYCfNEJ1u0W7Sv/7x1YVx8HyXvup58qpcik3TeOBVMsiODzRJkDZ/hFjZubmaBs1+CZgWgiyp1vSs7w9ujDR9fhmuQOH/jOG6V1cV0ysK+hzuQUXk34s=",
		
		//异步通知地址
		'notify_url' => "http://www.tpshop.com/index.php/home/cart/notify",
		
		//同步跳转
		'return_url' => "http://www.tpshop.com/index.php/home/cart/flow3",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAynuBdT6QVqFKedUT/hmo2k5ufU4Vtu+9x50bv/hBN7bQcOJ7vWn5jjM2e/OoQdkSlL1uamxjggkairyNDi9IMhJVTuSGrhKKEOZLbtjeNpBnLMFBbEWU105Y5rwh2KrUpCBvQXOYPdjHw8PCm/qDYptUcyiTvNY2LHbi/JyPZJtu6DHmpvFt/24vnsZlnkN+XO7AJeAfdE84yfqQOYHZ1s7UTz+3uqCb4+4No7wu3Xm5S7SNXATt093JDBQ1cnNvChm5107ucZzm89JzI0QQ+riRDIlvlMhktlGjdG+V7qR2DyPnfLBgCxuQIXUETJXOtkoEX8521KbszX1UQYU9gwIDAQAB",
);