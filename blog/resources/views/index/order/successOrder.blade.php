@include('index/index/title')
  <body>
    <div class="maincont">
     <header>
      <a href="{{url('/car/index')}}" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="susstext">订单提交成功</div>
     <div class="sussimg">&nbsp;</div>
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="50%">
         <h3>订单号：{{$orderInfo->order_no}}</h3>
         <time>创建日期：{{date('Y-m-d H:i:s',$orderInfo->create_time)}}<br />失效日期：{{date('Y-m-d H:i:s',$orderInfo->update_time)}}</time>
         <strong class="orange">应付：¥{{$orderInfo->order_amount}}</strong>
        </td>
        <td align="right"><span class="orange">等待支付</span></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     <div class="succTi orange">请您尽快完成付款，否则订单将被取消</div>
     
    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <td width="20%"><a href="{{url('/')}}" class="jiesuan" style=background:#5ea626;>继续购物</a></td>
       <td width="40%"><a href="{{'/order/pcpay'}}" class="jiesuan">电脑立即支付</a></td>
          <td width="40%"><a href="{{'/order/mopay'}}" class="jiesuan">手机立即支付</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
  </body>
</html>

<script src="/js/jquery.min.js"></script>