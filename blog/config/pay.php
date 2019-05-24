<?php
    return [
        //应用ID,您的APPID。
        'app_id' => "2016100100636228",

        "seller_id" => "2088102178042292",

        //商户私钥
        'merchant_private_key' => "MIIEowIBAAKCAQEAw3q/ClTowFKv3yKiYrgVEEUoIwbosdWBNmSogIIedETkXNaNUBPsO6CtWjhs8QzrlXXXmJJDPBeOQ4Y73UA+a1gVIV81SAYRgNl7Cwm89eaG+KNvwCQbiZDJxjlIL7nUUycemo3UAyTJbgxkMwKJZrKEhNamI8oRCsjnFF8y6UjrOdnUgYgvWNdnaSRam09JAnBHFjX0vbYj7RBXAyAUJPFd22ti5+GOVPGBPuBd9TpmqgS6VugIKNN9EvXgNsY5QnPSbCaf7Ynyw3Brp4iee2JdqUN2xksqkQNPGsRaYTISqPRqlKzVIST0lIcFLLFgnrhOipUG1mPNySC6FbfPLwIDAQABAoIBACYSVfrRJrOuZwpyWGYZrCCLF5Ia2l8oUg4h9J9yuDO05zUdpFAgUTYbySd1LeKUvZ1SYjcY5XdirxZ/olEpHf8SHKtvO5VXeTk7Ije4IdFSoJ70VeN6JNLaHDI7HdANxUicqd04Gj6yf3ireShmKhSSWDT3CUyXIlKTZk4VbHj6n1zcHceDzOIcKMQD95N0ROC7QRU7eQzYEUzpko2YEbvoE0NWG0HpeaRlC0x/msRVJIu6Kgk9GXnvzAvN+ppMGV1/bM+0998pbqlmQbhaOF25K5/YYjaDkBuf3gYzqItf70BoyW5sAk1jvnOTG/VW63noqaoCcBMO9YiD91Do98ECgYEA77qEdQqD/DZnWeqPf0ahQgMX8TlooU6a49qVQP+YiCXAs2W/wVHTJ/uEm4MoaEdk3x9kktVtTDT+vwxE9o6jDy1sUgZzFsNqM+A+xkDeTS9r8emkxGVlHL0bhnW7JQhVecwYefZezoi87HunmIez8vj2osgdmEYrvZ6iWmiPKgcCgYEA0L9dLp1prVwt45z46ASeItDPwUZeKuno01jH8+9CkPin0Uz39DfbThVrnrPg47WysaR77+vgPtHeuxDWz6h7+x49SWFA0lPlOX7kujUWSW+NTFwj1H8brCEVPRc+V8iGs/jba/Dohpt+f3yP2ZT3or2AIpm1ubRrjl8XcpeSh5kCgYB37LWwm1cVh93B9H5erGWlUUjb6t01vM3taH676mFS0pgI5sC7pARe/wsChOVk7TpACENW1R/9PJGn3ypssURPJmkGy6UtYQqy8t5UbUUIFc4JUdmUSij/7HZlmGXLi9S+vmQMNzyMU4k3QFDCFDjoNrWjDzsG3yuoi0AqvB3KZwKBgFYYd0BAoFNmD28vUOGw9d/6K5XVhgVBEEwK8/1CEzxjsiN7EVFisErWPtrn6btBN4BZDNz5djWyraCN42smXGxIHpLjT67v9zztfzzlpFmJbsetwQFlo24s/uuBaK8f/56+5xDv/Zd3DodaQqJE9JXkfrLGntMG/M1tnugeZ8sRAoGBALAKEruX9t3pO9Y52tE1gq1cFqQffX+Su4NKTXOnKncA4hhpUW3Cw767nRl7cZbNKNDDPvtByKI3hU0A8RBVkBKtJxPPil10/peIuLBJtw8S5+YwVTvDoPlai24HZblm4LNdsXXyljYzYlsQM7jXONM5J9cL3ioFJgd6rDoxZnMl",

        //异步通知地址
        'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",

        //同步跳转
        'return_url' => "http://www.laravel.com/order/returnpay",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlganf2WHstrZMFFFhRyRt14G1S8BEB3gedytnqUT1qGN1ult4ZUh9ydID9anAlm8Ld39SZbEYRJLL7pdDGub0y/RqVSo4YazsWmn4bblM4MW4eyFAw3PNRVTca4bVJ3Z5RzwZy8GfOzN8s7jaxmp5Ipe+dfe7rab/dvGJ+j98m09iXh5DmRohz57a1OY3lxeFfG2w85BIUCeYG3TdcSXIiqgwiA+MWMRFdh9OwG1H8W1V965J7yLMzsxWmnWppiitP1I+wPv12II74Oo3ccybZnbd+3UsZuHGkburoY56LgcobsEwq5vEp9hE4+ByHwuG2oc5AOmRtdZFtsP1GmvdQIDAQAB",
        ];