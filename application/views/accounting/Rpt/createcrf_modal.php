<style>
  /* Styling for all input and select inside the modal */
  .modal input[type="text"],
  .modal input[type="date"],
  .modal input[type="file"],
  .modal select {
    border: 1px solid #ccc;
    border-radius: 2px;
    padding: 4px 6px;
    font-size: 14px;
    background-color: #ffffff;
    color: #333;
    box-shadow: none;
  }

  .modal input[type="text"]:focus,
  .modal input[type="date"]:focus,
  .modal input[type="file"]:focus,
  .modal select:focus {
    border-color: #0056b3;
    outline: none;
    background-color: #fff;
  }

  /* 💸 Peso symbol styling for input group */
  .modal .input-group-addon {
    background-color: #007bff;
    color: white;
    border: 1px solid #007bff;
  }

  /* Optional: dashed border for file upload */
  .modal input[type="file"] {
    border-style: dashed;
  }

  /* Styling for the amount in words display */
  #amount_words {
    background-color: #f1f1f1;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    display: block;
    color: #ff6600;
    font-size: 13px;
    margin-top: 5px;
  }
</style>

<!-- For Modal Form -->

<div class="modal-fade crf modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h5><i class="fa fa-edit"></i>Add CRF</h5>
      </div>
      <!-- ============BODY=========== -->
      <div class="modal-body" style="border-radius: 5px;">
        <div style="text-align: center;">
          <img src="<?= base_url('assets/logo/AGC.jpg') ?>" alt="AGC Logo" style="width: 200px; height: 50px;">
          <h5 style="font-family: 'Times New Roman', serif; margin: 5px 0;">ICM Northwing, Dampas Dist., Tagbilaran City</h5>
          <h5 style="font-family: 'Times New Roman', serif; margin: 3px 0; font-weight: bold;">CHEQUE REQUEST FORM</h5>  
        </div>

        <?php
          $latest_crf_no = $this->Payment_model->get_latest_crf_no();
          $new_crf_no = "CRF-0005"; // Default Value

          if (!empty($latest_crf_no)) {
              // Extract numeric part (after 'CRF-')
              $max_id = (int) substr($latest_crf_no, 4);

              // Increment the numeric part
              $new_id = $max_id + 1;

              // Pad with leading zeros to make it 4 digits
              $new_crf_no = "CRF-" . str_pad($new_id, 4, '0', STR_PAD_LEFT);
          }
        ?>

        <div class="row">
          <?php echo form_open_multipart('Rpt/submit_crf_rpt/'); ?>
          <!-- Hidden inputs here -->

          <input type="hidden" name="pr_id" id="pr_id" value="<?= isset($pr_id) ? $pr_id : '' ?>">
          <input type="hidden" name="is_no" id="is_no" value="<?= isset($is_no) ? $is_no : '' ?>">
          <input type="hidden" name="type" id="type" value="<?= isset($type) ? $type : '' ?>">
          
            <!-- <input type="hidden" name="pr_id" id="pr_id" value="">
            <input type="hidden" name="is_no" id="is_no" value="">
            <input type="hidden" name="type" id="type" value=""> -->

            <div class="col-md-12 col-xs-12 col-sm-12" style="padding-top:15px;">
              <div class="col-md-2 col-xs-2 col-sm-2">
                <label>CRF #:</label>
              </div>
              <div class="col-md-5 col-xs-5 col-sm-5 form-inline">
                <input type="text" class="form-control inb" name="crf_no" value="<?php echo $crf_no; ?>" readonly>
              </div>

              <div class="col-md-1 col-xs-1 col-sm-1"></div>

              <div class="col-md-1 col-xs-1 col-sm-1">
                <label>Date:</label>
              </div>
              <div class="col-md-3 col-xs-3 col-sm-3 form-inline">
                <input type="text" class="form-control inb" value="<?= date('Y-m-d') ?>" name="date_requested" readonly>
              </div>
            </div>

            <!-- Add Tax Year To Be Paid dropdown -->
            <div class="col-md-12 col-xs-12 col-sm-12" style="padding-top:15px;" id="taxYearGroup">
              <div class="col-md-2 col-xs-2 col-sm-2">
                <label>Tax Year to be Paid:</label>
              </div>
              <div class="col-md-5 col-xs-5 col-sm-5">
                <select name="tax_year_paid" class="form-control inb">
                  <option value="">-- Select Year & Month --</option>
                  <?php
                    $start_year = 2000;
                    $end_year = date('Y') + 5;
                    $months = [
                      '01' => 'January', '02' => 'February', '03' => 'March',
                      '04' => 'April', '05' => 'May', '06' => 'June',
                      '07' => 'July', '08' => 'August', '09' => 'September',
                      '10' => 'October', '11' => 'November', '12' => 'December'
                    ]; 

                    for ($year = $start_year; $year <= $end_year; $year++) {
                      foreach ($months as $num => $name) {
                        echo "<option value=\"$year-$num\">$name $year</option>";
                      }                      
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12">
              <div class="col-md-2 col-xs-2 col-sm-2">
                <label>Pay to:</label>
              </div>
              <div class="col-md-10 col-xs-10 col-sm-10">
                <input type="text" class="form-control inb" name="pay_to" placeholder="Payor Name" required>
              </div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12">
              <div class="col-md-2 col-xs-2 col-sm-2">
                <label class="control-label">Amount in Figure:</label> 
              </div>
              <div class="col-md-10 col-xs-10 col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">₱</span>
                  <input type="text" class="form-control inb" name="amount" id="amount" required placeholder="Enter Amount (e.g., 1,000.00)">
                </div>
              </div>
            </div>

            <div class="div4 col-md-12 col-xs-12 col-sm-12" style="margin-top: 10px;">
              <div class="col-md-2 col-xs-2 col-sm-2">
                <label class="control-label">Amount in Words :</label>
              </div>
              <div class="col-md-10 col-xs-10 col-sm-10">
                <span class="form-control input_border" id="amount_words" style="color:#ff6600;font-size:12px; height:auto;"></span>
              </div>
            </div>

            <div class="col-md-12 col-xs-12 col-sm-12" style="text-align:center;padding-top:10px">
              <div class="col-md-2 col-sm-2 col-xs-2"></div>
              <div class="col-md-4 col-sm-4 col-xs-4">
                <input type="text" class="form-control inb"  name="bank" style="text-align:center" placeholder="ex: PNB, BPI, BDO, etc." required>
                <label>Bank</label> 
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <input type="text" class="form-control inb" name="cheque_no" style="text-align:center" required>
                <label>Cheque No.</label> 
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <input type="date" class="form-control inb" value="<?php echo date("F d, Y"); ?>" name="cheque_date" style="text-align:center" required>
                <label class="control-label">Cheque Date</label> 
              </div>
            </div>

            <!-- Attach file upload input -->
            <div class="col-md-12 space" style="margin-top: 15px;">
              <label class="col-md-2">Attach File<b style="float:right">:</b></label>
              <div class="col-md-10">
                <input type="file" name="file_upload" class="form-control">
              </div>
            </div>

            <!-- Existing file display (View button) -->
            <div class="col-md-12 space" style="margin-top: 10px;">
							<label class="col-md-2">Existing File<b style="float:right">:</b></label>
						  <div class="col-md-10">
								<?php if (!empty($data['filename']) && !empty($data['is_no'])):  
									$prefix = substr($data['is_no'], 0, 2);
									if ($prefix === "NA") {
										$folder = 'uploaded_documents';
									} elseif ($prefix === "ES") {
										$folder = 'es_uploads';
									} elseif ($prefix === "JS") {
										$folder = 'js_uploads';
									} else {
										$folder = 'other_uploads'; // fallback
									}
									$crf = base_url('assets/img/' . $folder . '/' . $data['is_no'] . '/CRF/' . $data['filename']);
								?>
									<button type="button" class="btn btn-default" onclick="viewImage('<?php echo $crf; ?>')">View File <span class="glyphicon glyphicon-folder-open"></span></button>
								<?php else: ?>
                  <span>No file attached yet.</span>
                <?php endif; ?>  
							</div>
						</div> 
          </div>
        </div>
        <div class="modal-footer" style="margin-top: 15px;">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="submit_crf" class="btn btn-sm btn-primary"> Submit</button>
        </div>       
      </form>        
      <!--==========BODY==========-->
    </div>
  </div>
</div>

<!-- End of Modal Form -->

<script>
  const amountInput = document.getElementById('amount');
  const amountWords = document.getElementById('amount_words');

  amountInput.addEventListener('input', function () {
    // Remove all characters except digits and dots
    let input = this.value.replace(/[^0-9.]/g, '');

    // Only allow ONE decimal point
    const firstDotIndex = input.indexOf('.');
    if (firstDotIndex !== -1) {
      // Cut off extra dots after the first one
      input = input.substring(0, firstDotIndex + 1) +
              input.substring(firstDotIndex + 1).replace(/\./g, '');
    }

    const parts = input.split('.');
    const intPart = parts[0] || '0';
    const decimalPart = parts[1] || '';

    // Format integer part with commas
    const formattedInt = Number(intPart).toLocaleString('en-US');
    let displayValue = decimalPart !== '' || input.endsWith('.')
      ? `${formattedInt}.${decimalPart}`
      : formattedInt;

    this.value = displayValue;

    // Parse to float for conversion
    const numericValue = parseFloat(`${intPart}.${decimalPart}`);
    if (!isNaN(numericValue)) {
      const pesos = Math.floor(numericValue);
      const centavos = Math.round((numericValue - pesos) * 100);

      let words = convertNumberToWords(pesos) + ' peso' + (pesos !== 1 ? 's' : '');
      if (centavos > 0) {
        words += ' and ' + convertNumberToWords(centavos) + ' centavo' + (centavos !== 1 ? 's' : '');
      }
      amountWords.innerText = words + ' only';
    } else {
      amountWords.innerText = '';
    }
  });

  function convertNumberToWords(amount) {
    const th = ['', 'thousand', 'million', 'billion', 'trillion'];
    const dg = ['zero','one','two','three','four','five','six','seven','eight','nine'];
    const tn = ['ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen'];
    const tw = ['twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety'];

    amount = amount.toString().replace(/[\, ]/g, '');
    if (amount != parseFloat(amount)) return 'not a number';

    let x = amount.indexOf('.');
    if (x == -1) x = amount.length;
    if (x > 15) return 'too big';

    let n = amount.split('');
    let str = '';
    let sk = 0;

    for (let i = 0; i < x; i++) {
      if ((x - i) % 3 === 2) {
        if (n[i] === '1') {
          str += tn[Number(n[i + 1])] + ' ';
          i++;
          sk = 1;
        } else if (n[i] !== '0') {
          str += tw[n[i] - 2] + ' ';
          sk = 1;
        }
      } else if (n[i] !== '0') {
        str += dg[n[i]] + ' ';
        if ((x - i) % 3 === 0) str += 'hundred ';
        sk = 1;
      }

      if ((x - i) % 3 === 1 && sk) {
        str += th[(x - i - 1) / 3] + ' ';
        sk = 0;
      }
    }

    return str.replace(/\s+/g, ' ').trim();
  }
</script>

<!-- <script>
document.querySelector('form').addEventListener('submit', function(e) {
    const type = document.querySelector('[name="type"]').value;
    const taxYear = document.querySelector('[name="tax_year_paid"]').value;

    if (type === 'RPT' && taxYear === '') {
        alert('Please select Tax Year to be Paid for RPT type.');
        e.preventDefault();
    }
});
</script> -->






