<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
  	
    <li <?php echo strstr('/order/default',strtolower(Yii::app()->getController()->module->id.'/'.Yii::app()->getController()->id))?'class="active"':''; ?>><a href="/order/default"><i class="icon icon-home"></i> <span>订单管理</span></a> </li>
    <li <?php echo strstr('/default/menu',strtolower(Yii::app()->getController()->module->id.'/'.Yii::app()->getController()->id))?'class="active"':''; ?>> <a href="/default/menu"><i class="icon icon-signal"></i> <span>菜单管理</span></a> </li>
    <li <?php echo strstr('/default/dish',strtolower(Yii::app()->getController()->module->id.'/'.Yii::app()->getController()->id))?'class="active"':''; ?>> <a href="/default/dish"><i class="icon icon-inbox"></i> <span>菜品管理</span></a> </li>
    <li <?php echo strstr('/user/user',strtolower(Yii::app()->getController()->module->id.'/'.Yii::app()->getController()->id))?'class="active"':''; ?>><a href="/user/user"><i class="icon icon-tint"></i> <span>用户管理</span></a></li>
    <li <?php echo strstr('/default/distributor',strtolower(Yii::app()->getController()->module->id.'/'.Yii::app()->getController()->id))?'class="active"':''; ?>><a href="/default/distributor"><i class="icon icon-tint"></i> <span>配送员管理</span></a></li>
    <!-- <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Forms</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="form-common.html">Basic Form</a></li>
        <li><a href="form-validation.html">Form with Validation</a></li>
        <li><a href="form-wizard.html">Form with Wizard</a></li>
      </ul>
    </li>
    <li><a href="buttons.html"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>
    <li><a href="interface.html"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label label-important">5</span></a>
      <ul>
        <li><a href="index2.html">Dashboard2</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="calendar.html">Calendar</a></li>
        <li><a href="invoice.html">Invoice</a></li>
        <li><a href="chat.html">Chat option</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-info-sign"></i> <span>Error</span> <span class="label label-important">4</span></a>
      <ul>
        <li><a href="error403.html">Error 403</a></li>
        <li><a href="error404.html">Error 404</a></li>
        <li><a href="error405.html">Error 405</a></li>
        <li><a href="error500.html">Error 500</a></li>
      </ul>
    </li>
    <li class="content"> <span>Monthly Bandwidth Transfer</span>
      <div class="progress progress-mini progress-danger active progress-striped">
        <div style="width: 77%;" class="bar"></div>
      </div>
      <span class="percent">77%</span>
      <div class="stat">21419.94 / 14000 MB</div>
    </li>
    <li class="content"> <span>Disk Space Usage</span>
      <div class="progress progress-mini active progress-striped">
        <div style="width: 87%;" class="bar"></div>
      </div>
      <span class="percent">87%</span>
      <div class="stat">604.44 / 4000 MB</div>
    </li> -->
  </ul>
</div>
<!--sidebar-menu-->