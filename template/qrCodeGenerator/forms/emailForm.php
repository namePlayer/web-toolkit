<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label for="qrcodeGeneratorEmailFormEmailRecipientAddressInput" class="form-label">
                <?= $this->e($this->translate('qrcode-generator-preset-email-recipient-email-label')) ?>
            </label>
            <input type="email" class="form-control" name="qrcodeGeneratorEmailFormEmailRecipientAddressInput" id="qrcodeGeneratorEmailFormEmailRecipientAddressInput"
                   placeholder="<?= $this->e($this->translate('qrcode-generator-preset-email-recipient-email-placeholder')) ?>"
                   value="<?= $object instanceof \App\DTO\QrCodeGenerator\EmailQrCodeDTO ? $object->getRecipient() : '' ?>">
        </div>
    </div>
    <div class="col-12">
        <div class="mb-3">
            <label for="qrcodeGeneratorEmailFormSubjectInput" class="form-label">
                <?= $this->e($this->translate('qrcode-generator-preset-email-subject-label')) ?>
            </label>
            <input type="text" class="form-control" name="qrcodeGeneratorEmailFormSubjectInput" id="qrcodeGeneratorEmailFormSubjectInput"
                   placeholder="<?= $this->e($this->translate('qrcode-generator-preset-email-subject-placeholder')) ?>"
                   value="<?= $object instanceof \App\DTO\QrCodeGenerator\EmailQrCodeDTO ? $object->getSubject() : '' ?>">
        </div>
    </div>
    <div class="col-12">
        <div class="mb-3">
            <label for="qrcodeGeneratorEmailFormMessage" class="form-label">
                <?= $this->e($this->translate('qrcode-generator-preset-email-message-label')) ?>
            </label>
            <textarea name="qrcodeGeneratorEmailFormMessage" rows="3" id="qrcodeGeneratorEmailFormMessage" class="form-control"
                      placeholder="<?= $this->e($this->translate('qrcode-generator-preset-email-message-placeholder')) ?>"><?= $object instanceof \App\DTO\QrCodeGenerator\EmailQrCodeDTO ? $object->getMessage() : '' ?></textarea>
        </div>
    </div>
</div>