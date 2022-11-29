<div class="form-group <?php echo e($errors->has('code') ? ' has-error' : ''); ?>">
    <label class="control-label col-md-2" for="code">CODE <sup class="text-danger">*</sup></label>
    <div class="col-md-10">
        <input class="form-control" name="code" id="code" type="text" placeholder="CODE"
               value="<?php echo e(old('code',isset($setting)?$setting->code:null)); ?>"/>
        <span class="help-block">
                            code will be used for getting the setting value
                        </span>
    </div>
</div>
<div class="form-group <?php echo e($errors->has('label') ? ' has-error' : ''); ?>">
    <label class="control-label col-md-2" for="label">LABEL <sup class="text-danger">*</sup></label>
    <div class="col-md-10">
        <input class="form-control" name="label" id="label" type="text" placeholder="LABEL"
               value="<?php echo e(old('label',isset($setting)?$setting->label:null)); ?>"/>
        <span class="help-block">
            label describes the setting
        </span>
    </div>
</div>













<?php /**PATH /var/www/html/particle_role/resources/views/vendor/settings/shared_input.blade.php ENDPATH**/ ?>