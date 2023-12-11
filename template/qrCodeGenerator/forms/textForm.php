<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label for="qrcodeGeneratorTextFormTextareaInput" class="form-label"><?= $this->e($this->translate('qrcode-generator-preset-text-input-label')) ?></label>
            <textarea name="qrcodeGeneratorTextFormTextareaInput" rows="3" id="qrcodeGeneratorTextFormTextareaInput" class="form-control"
                      placeholder="<?= $this->e($this->translate('qrcode-generator-preset-text-input-placeholder')) ?>"><?= $object instanceof \App\DTO\QrCodeGenerator\TextQrCodeDTO ? $object->getText() : '' ?></textarea>
        </div>
    </div>
</div>