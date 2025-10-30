
 <div class="row">
     <div class="col-sm">
         <div class="mb-3">
             <label>Twitter</label>
             <input type="url" name="url_twitter" class="form-control">
         </div>
     </div>
     <div class="col-sm">
         <div class="mb-3">
             <label>Instagram</label>
             <input type="url" name="url_instagram" class="form-control">
         </div>
     </div>
     <div class="col-sm">
         <div class="mb-3">
             <label>Youtube</label>
             <input type="url" name="url_youtube" class="form-control">
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-sm-4">
         <div class="mb-3">
             <label>Status Pemerintahan <span class="text-danger">*</span></label>
             <select name="status_pemerintahan" class="form-control shadow-sm" required>
                 <option value="1">Desa</option>
                 <option value="2">Nagari</option>
                 <option value="3">Gampong</option>
                 <option value="4">Kampung</option>
                 <option value="5">Kelurahan</option>
             </select>
         </div>
     </div>
     <div class="col-sm-4">
         <div class="mb-3">
             <label>Jumlah RW<span class="text-danger">*</span></label>
             <input type="number" name="jml_rw" class="form-control" required>
         </div>
     </div>
     <div class="col-sm-4">
         <div class="mb-3">
             <label>Jumlah RT<span class="text-danger">*</span></label>
             <input type="number" name="jml_rt" class="form-control" required>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-sm-6">
         <div class="mb-3">
             <label>No SK Pendirian Desa</label>
             <input type="text" name="no_sk_pendirian_desa" class="form-control">
         </div>
     </div>
     <div class="col-sm-6">
         <div class="mb-3">
             <label>Tgl SK Pendirian Desa<span class="text-danger">*</span></label>
             <input type="date" name="tgl_sk_pendirian_desa" class="form-control"
                 required>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-sm-6">
         <div class="mb-3">
             <label>No SK Peta Desa</label>
             <input type="text" name="no_sk_peta_desa" class="form-control">
         </div>
     </div>
     <div class="col-sm-6">
         <div class="mb-3">
             <label>Tgl SK Peta Desa<span class="text-danger">*</span></label>
             <input type="date" name="tgl_sk_peta_desa" class="form-control" required>
         </div>
     </div>
 </div>


 <div class="row">
     <div class="col-sm-3">
         <div class="mb-3">
             <label>Luas Wilayah (Ha)<span class="text-danger">*</span></label>
             <input type="number" step="0.01" name="luas_wilayah"
                 class="form-control" required>
         </div>
     </div>
     <div class="col-sm-3">
         <div class="mb-3">
             <label>Lokasi Desa<span class="text-danger">*</span></label>
             <input type="text" name="lokasi_desa" class="form-control" required>
         </div>
     </div>
     <div class="col-sm-3">
         <div class="mb-3">
             <label>Topografi</label>
             <select name="topografi" class="form-control shadow-sm">
                 <option value="1">Lereng/Puncak</option>
                 <option value="2">Lembah</option>
                 <option value="3">Dataran</option>
             </select>
         </div>
     </div>
     <div class="col-sm-3">
         <div class="mb-3">
             <label>Jumlah Warga di Lereng/Puncak<span class="text-danger">*</span></label>
             <input type="number" name="jml_warga" class="form-control" required>
         </div>
     </div>
 </div>