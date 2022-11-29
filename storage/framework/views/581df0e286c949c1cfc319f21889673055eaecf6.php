<div class="form-group <?php echo e($errors->has('value') ? ' has-error' : ''); ?>">
    <label class="control-label col-md-2" for="value">VALUE <sup class="text-danger">*</sup></label>
    <div class="col-md-10">
        <input class="form-control" name="value" id="value" type="text" placeholder="VALUE" value="<?php echo e(old('value',$setting->value)); ?>"/>
        <span class="help-block">the value that assigned to this setting</span>
    </div>
</div><?php /**PATH /var/www/html/particle_role/resources/views/vendor/settings/types_value/text.blade.php ENDPATH**/ ?>