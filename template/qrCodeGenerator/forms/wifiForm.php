<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="qrcodeGeneratorWifiFormNetworkNameInput" class="form-label">
                <?= $this->e($this->translate('qrcode-generator-preset-wifi-network-name-label')) ?>
            </label>
            <input type="text" name="qrcodeGeneratorWifiFormNetworkNameInput" id="qrcodeGeneratorWifiFormNetworkNameInput" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="qrcodeGeneratorWifiFormEncryptionSelect" class="form-label">
                <?= $this->e($this->translate('qrcode-generator-preset-wifi-network-encryption-label')) ?>
            </label>
            <select id="qrcodeGeneratorWifiFormEncryptionSelect" name="qrcodeGeneratorWifiFormEncryptionSelect" class="form-select">
                <option selected><?= $this->e($this->translate('qrcode-generator-preset-wifi-network-encryption-none')) ?></option>
                <option value="WEP"><?= $this->e($this->translate('qrcode-generator-preset-wifi-network-encryption-wep')) ?></option>
                <option value="WPA"><?= $this->e($this->translate('qrcode-generator-preset-wifi-network-encryption-wpa')) ?></option>
            </select>
        </div>
    </div>
    <div class="col-md-8">
        <div class="mb-3">
            <label for="qrcodeGeneratorWifiFormPasswordInput" class="form-label">
                <?= $this->e($this->translate('qrcode-generator-preset-wifi-network-password-label')) ?>
            </label>
            <input type="password" name="qrcodeGeneratorWifiFormPasswordInput" id="qrcodeGeneratorWifiFormPasswordInput" class="form-control">
        </div>
    </div>
    <div class="col-4"></div>
    <div class="col-md-4">
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="qrcodeGeneratorWifiFormHiddenNetwork" name="qrcodeGeneratorWifiFormHiddenNetwork">
                <label class="form-check-label" for="qrcodeGeneratorWifiFormHiddenNetwork">
                    <?= $this->e($this->translate('qrcode-generator-preset-wifi-network-visibility-label')) ?>
                </label>
            </div>
        </div>
    </div>
    <div class="col-4"></div>
</div>