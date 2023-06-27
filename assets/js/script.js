	
		// let jumlah = $('#jumlah').val();
		// $('#total').val(harga*jumlah);
    // var base_url = 'http://localhost/UPN-MARKET/';






    
        $('#cek_pendapatan').on('click',function(){
            let base_url = 'http://localhost/UPN-MARKET/';
            let cek_awal = $('#cek_awal').val()
            let cek_akhir = $('#cek_akhir').val()
            $.ajax({
                    url: base_url+'PenyediaController/cek_pendapatan',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'cek_awal': cek_awal,
                        'cek_akhir': cek_akhir
                    },
                    success: function (data) {
                        console.log(data)
                        $('#produk_penyedia').html('')
                        $('#total_cek').val('Rp '+ data.total['total_harga']);
                        let produk = data.transaksi;
                        let a = 0;
                        $.each(produk, function(i, data){
                            a++;
                            $('#produk_penyedia').append(`
                                  
                                    <tr>
                                      <th scope="row">`+a+`</th>
                                      <td>`+data.id_transaksi+`</td>
                                      <td>`+data.nama_produk+`</td>
                                      <td>Rp `+data.harga+`</td>
                                      <td>`+data.title+`</td>
                                      <td>`+data.penyelenggara+`</td>
                                      <td>`+data.notelp+`</td>
                                      <td>`+data.start+`</td>
                                      <td>`+data.end+`</td>
                                      <td> 
                                        <a href="`+base_url+`/assets/file/`+data.file_doc+`"></a>
                                      </td>
                                      <td>`+data.jumlah+`</td>
                                      <td>`+data.ongkir+`</td>
                                      <td>`+data.estimasi_waktu+`</td>
                                      <td>Rp `+data.ongkir+`</td>
                                      <td>`+data.estimasi_waktu+`</td>
                                      <td>Rp `+data.total_harga+`</td>
                                      <td>`+data.status+`</td>
                                      <td>
                                        <a href="`+base_url+'assets/gambar/' + data.bukti_bayar +`" target="blank">
                                            <img src="`+base_url+'assets/gambar/' + data.bukti_bayar+`" alt="" style="max-height: 100px; max-width: 100px">
                                            <p>`+data.bukti_bayar+`</p>
                                        </a>
                                      </td>
                                    </tr>

                            `);

                        })
                    }
                });
            
        });

        $('#btn_cari_penyedia').on('click', function(){
            
            let base_url = 'http://localhost/UPN-MARKET/';
            let cari = $('#cari_penyedia').val()

            $.ajax({
                url: base_url+'PenyediaController/cari_produk',
                type : 'POST',
                dataType: 'json',
                data: {
                    'cari' : cari
                },
                success: function(data){
                    console.log(data)
                    $('#produk_penyedia').html('')
                    let a = 0;
                        $.each(data, function(i, data){
                            a++;
                            $('#produk_penyedia').append(`
                                  
                                    <tr>
                                      <th scope="row">`+a+`</th>
                                      <td>`+data.id_transaksi+`</td>
                                      <td>`+data.nama_produk+`</td>
                                      <td>Rp `+data.harga+`</td>
                                      <td>`+data.title+`</td>
                                      <td>`+data.penyelenggara+`</td>
                                      <td>`+data.notelp+`</td>
                                      <td>`+data.start+`</td>
                                      <td>`+data.end+`</td>
                                      <td>
                                        <a href="`+base_url+'assets/gambar/'+data.file_gambar+`" target="blank">
                                            <img src="`+base_url + 'assets/gambar/' + data.file_gambar+`" alt="" style="max-width: 150px;max-height: 150px">
                                        </a>
                                      </td>
                                      <td> <a href="`+base_url+'assets/file/'+data.file_doc+`" target="blank">`+data.file_doc+`</a>
                                        
                                      </td>
                                      <td>`+data.jumlah+`</td>
                                      <td>Rp `+data.ongkir+`</td>
                                      <td>`+data.estimasi_waktu+`</td>
                                      <td>Rp `+data.total_harga+`</td>
                                      <td>`+data.status+`</td>
                                      <td>
                                        <a href="`+base_url+'assets/gambar/' + data.bukti_bayar +`" target="blank">
                                            <img src="`+base_url+'assets/gambar/' + data.bukti_bayar+`" alt="" style="max-height: 100px; max-width: 100px">
                                            <p>`+data.bukti_bayar+`</p>
                                        </a>
                                      </td>
                                    </tr>

                            `);

                        })
                }
            })
        })




        $('#btn_cari_admin').on('click',function(){
            $('#produk-list').html('');
            let base_url = 'http://localhost/UPN-MARKET/';
            let cari = $('#cari_admin').val()

            $.ajax({
                url: base_url+'AdminController/cari_transaksi',
                type : 'POST',
                dataType : 'json',
                data : {
                    'cari' : cari
                },
                success: function(data){
                    console.log(data)
                    var a = 0
                    $.each(data, function(i, data){
                            a++;
                            $('#produk-list').append(`
                                    <tr>
                                      <th scope="row">`+a+`</th>
                                      <td>`+data.id_transaksi+`</td>
                                      <td>`+data.nama_produk+`</td>
                                      <td>`+data.nama+`</td>
                                      <td>Rp `+data.harga+`</td>
                                      <td>`+data.title+`</td>
                                      <td>`+data.penyelenggara+`</td>
                                      <td>`+data.notelp+`</td>
                                      <td>`+data.start+`</td>
                                      <td>`+data.end+`</td>
                                      <td>`+data.jumlah+`</td>
                                      <td>Rp `+data.total_harga+`</td>
                                      <td>`+data.status+`</td>
                                    </tr>

                            `);

                        })
                }
            })
        })



        $('#cek_pendapatan_admin').on('click',function(){
            $('#produk-list').html('');
            let base_url = 'http://localhost/UPN-MARKET/';
            let cek_awal = $('#cek_awal_admin').val()
            let cek_akhir = $('#cek_akhir_admin').val()
            $.ajax({
                    url: base_url+'AdminController/cek_pendapatan',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'cek_awal': cek_awal,
                        'cek_akhir': cek_akhir
                    },
                    success: function (data) {
                        
                        $('#total_cek_admin').val('Rp '+ data.total['total_harga']);
                        let produk = data.transaksi;
                        let a = 0;
                        $.each(produk, function(i, data){
                            a++;
                            $('#produk-list').append(`
                                    <tr>
                                      <th scope="row">`+a+`</th>
                                      <td>`+data.id_transaksi+`</td>
                                      <td>`+data.nama_produk+`</td>
                                      <td>`+data.nama+`</td>
                                      <td>Rp `+data.harga+`</td>
                                      <td>`+data.title+`</td>
                                      <td>`+data.penyelenggara+`</td>
                                      <td>`+data.notelp+`</td>
                                      <td>`+data.start+`</td>
                                      <td>`+data.end+`</td>
                                      <td>`+data.jumlah+`</td>
                                      <td>Rp `+data.total_harga+`</td>
                                      <td>`+data.status+`</td>
                                    </tr>

                            `);

                        })
                    }
                });
            
        });
	
	let id_produk = $('#id_produk').val();
	
  	var date_last_clicked = null;
        $(document).ready(function(){
            let base_url = 'http://localhost/UPN-MARKET/';
        	$.post(base_url+'PelangganController/tampil_kalendar/'+id_produk, function(data){


                $('#calendar').fullCalendar({
                navLinks:true,
                editable:true,
                eventLimit:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events: base_url+'PelangganController/tampil_kalendar/'+id_produk,
                selectable:true,
                selectHelper:true,
                editable:true,
                 select: function(start, end) {
                
	                // $('#start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
	                // $('#end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
	                 // membuka modal
	                 // let start = moment(start).format('YYYY-MM-DD HH:mm:ss');
	                 // let end = moment(end).format('YYYY-MM-DD HH:mm:ss');
                     // +'/'+moment(start).format('YYYY-MM-DD HH:mm:ss')+'/'+moment(end).format('YYYY-MM-DD HH:mm:ss')
                	let halaman = base_url+'PelangganController/transaksi_jasa/'+id_produk;
	                window.location.href = halaman;

	            }, 

               
               
                });
        	});
        });

        





	            

