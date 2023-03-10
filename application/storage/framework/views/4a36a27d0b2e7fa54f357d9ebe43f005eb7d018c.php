<nav class="top_navbar">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <?php echo $__env->make('cookieConsent::index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-12">
                <div class="navbar-logo">
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="<?php echo e(url(app()->getLocale().'/')); ?>">
                        <?php if (app()["auth"]->check() && app()["auth"]->user()->isImpersonated()): ?>

                        <?php else: ?>
                        <img src="<?php echo e(setting('site.logo_url')); ?>" height="42" alt="<?php echo e(setting('site.site_name')); ?>">
                        <?php endif; ?>
                        <span class="m-l-10"><?php if(setting('site.enable_text_logo')): ?><?php echo e(setting('site.site_name')); ?><?php endif; ?></span>
                    </a>
                </div>
                <?php if(auth()->guard()->check()): ?>
                <ul class="nav navbar-nav">
                    <?php if (app()["auth"]->check() && app()["auth"]->user()->isImpersonated()): ?>
                    <li class="dropdown task ">
                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="icon-user"></i>
                            <span class="label-count"><?php echo e(__('Impersonated')); ?></span>
                        </a>  
                    </li>
                    <?php endif; ?>
                    <li class="dropdown task ">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="icon-flag"></i>
                            <span class="label-count"><?php echo e(app()->getLocale()); ?></span>
                        </a>
                        <ul class="dropdown-menu  pullDown">
                            <li>
                                <a href="<?php echo e(route('home','en')); ?>">
                                    
                                    <span><?php echo e(__('English')); ?></span> 
                                </a>
                            </li>
                            <li>
                                <a  href="<?php echo e(route('home','zh_CN')); ?>">
                                    
                                    <span><?php echo e(__('Chinese')); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('home','es')); ?>">
                                    
                                    <span><?php echo e(__('Spanish')); ?></span> 
                                </a>
                            </li>   
                        </ul>
                    </li> 
                    <li class="dropdown profile"> 
                        <a href="javascript:void(0);" class="dropdown-toggle pr-0"  data-toggle="dropdown" role="button" aria-expanded="true"> <img src="<?php echo e(Auth::user()->currentWallet()->currency->thumb); ?>" alt="" class="rounded-circle"> </a>
                         <ul class="dropdown-menu pullDown">
                        
                            <?php if(count(Auth::user()->wallets())): ?>
                                <?php $__currentLoopData = Auth::user()->wallets(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $someWallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li> 
                               <a href="<?php echo e(url('/')); ?>/<?php echo e(app()->getLocale()); ?>/wallet/<?php echo e($someWallet->id); ?>">      
                                <span class="name"><?php echo e($someWallet->currency->name); ?></span>
                               
                                </a>
                            </li>              
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>                            
                          
                        </ul>
                    </li>
                    <li class="dropdown profile">
                        <a href="javascript:void(0);" class="dropdown-toggle pl-0" style="margin-left: -12px;" data-toggle="dropdown" role="button">
                            <img src="<?php echo e(Auth::user()->avatar()); ?>" alt="" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu pullDown">
                            <li>
                                <div class="user-info">
                                    <h6 class="user-name m-b-0"><?php echo e(Auth::user()->name); ?></h6>
                                    <?php if(Auth::user()->verified == 1 ): ?>
                                    <p class="user-position"><span class="badge badge-success ml-0 mt-3">Verified sp#<?php echo e(Auth::user()->id); ?></span> </p>
                                    <?php else: ?>
                                    <p class="user-position"><a class="" href="<?php echo e(url(app()->getLocale().'/')); ?>/resend/activationlink"><span class="badge badge-danger ml-0 mt-3">Verify your email</span></a></p>
                                    <?php endif; ?>
                                    <hr>
                                </div>
                            </li>                            
                            <li>
                                <a href="<?php echo e(route('profile.info',  app()->getLocale())); ?>"><i class="icon-user m-r-10"></i> <span><?php echo e(__('Profile')); ?></span> </a>
                            </li>
                            
                            <?php if (app()["auth"]->check() && app()["auth"]->user()->isImpersonated()): ?>
                            <li>
                                <a href="<?php echo e(route('impersonate.leave', app()->getLocale())); ?>"><i class="icon-power m-r-10"></i><span><?php echo e(__('Leave impersonation')); ?></span></a>
                            </li>
                            <?php endif; ?>
                            <li><a  href="<?php echo e(route('logout', app()->getLocale())); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-power m-r-10"></i><span>    <?php echo e(__('Logout')); ?></span></a><form id="logout-form" action="<?php echo e(route('logout', app()->getLocale())); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form></li>
                        </ul>
                    </li>
                    
                </ul>
                <?php endif; ?>
            </div>
        </div>        
    </div>
</nav> --}}