<script>
    // Script untuk mengambil ID dari datalist saat pengguna memilih opsi
    document.addEventListener("DOMContentLoaded", function() {
        const dataListCabang = document.getElementById('list-cabang');
        const dataListJabatan = document.getElementById('list-jabatan');

        const inputCabang = document.querySelector('input[name="cabang[]"]');
        const inputJabatan = document.querySelector('input[name="jabatan[]"]');

        inputCabang.addEventListener('input', function(e) {
            const selectedOption = Array.from(dataListCabang.options).find(option => option.value === e.target.value);
            if (selectedOption) {
                const cabangIdInput = document.querySelector('input[name="cabang_id[]"]');
                cabangIdInput.value = selectedOption.dataset.value;
            }
        });

        inputJabatan.addEventListener('input', function(e) {
            const selectedOption = Array.from(dataListJabatan.options).find(option => option.value === e.target.value);
            if (selectedOption) {
                const jabatanIdInput = document.querySelector('input[name="jabatan_id[]"]');
                jabatanIdInput.value = selectedOption.dataset.value;
            }
        });
    });
</script>

<script>
// Import External
// $(document).ready(function () {
//   $('#form1').submit(function (event) {
//     event.preventDefault();
//     var formData = new FormData(this);
//     var inputFile = $('input[name="file"]')[0].files[0];
//     if (!inputFile) {
//       Swal.fire({
//         title: "Error!",
//         text: "Silakan pilih file untuk diunggah.",
//         icon: "error",
//       });
//       return false;
//     }
//     Swal.fire({
//       title: 'Apakah Anda yakin ingin mengimpor data karyawan External ?',
//       text: "Anda tidak dapat mengembalikan data yang telah diimpor!",
//       icon: 'warning',
//       showCancelButton: true,
//       confirmButtonColor: '#3085d6',
//       cancelButtonColor: '#d33',
//       confirmButtonText: 'Ya, Impor!',
//       cancelButtonText: 'Batal'
//     }).then((result) => {
//       if (result.isConfirmed) {
//         var spinner = $('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
//         Swal.fire({
//           title: "Memproses data...",
//           html: spinner,
//           showConfirmButton: false
//         });

//         $.ajax({
//           url: "{{ route('employ.externalimport') }}",
//           type: "POST",
//           data: formData,
//           processData: false,
//           contentType: false,
//           success: function (response) {
//             $('input[name="file"]').val('');
//             Swal.fire({
//               title: "Sukses!",
//               text: "Data karyawan External berhasil diimport!",
//               icon: "success",
//             }).then((result) => {
//               location.reload();
//             });
//           },
//           error: function (response) {
//             $('input[name="file"]').val('');
//             Swal.fire({
//               title: "Error!",
//               text: response.responseJSON.message,
//               icon: "error",
//             });
//           },
//           complete: function () {
//             spinner.remove();
//           }
//         });
//       }
//     });
//   });
// });

$(document).ready(function () {
  $('#form1').submit(function (event) {
    event.preventDefault();
    var formData = new FormData(this);
    var inputFile = $('input[name="file"]')[0].files[0];
    if (!inputFile) {
      Swal.fire({
        title: "Error!",
        text: "Silakan pilih file untuk diunggah.",
        icon: "error",
      });
      return false;
    }
    Swal.fire({
      title: 'Apakah Anda yakin ingin mengimpor data karyawan External ?',
      text: "Anda tidak dapat mengembalikan data yang telah diimpor!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Impor!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        var spinner = $('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
        var progressDiv = $('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div></div>');
        var percentageText = $('<div class="percentage-text">0%</div>');
        
        var progressContainer = $('<div class="progress-container"></div>');
        progressContainer.append(progressDiv);
        progressContainer.append(percentageText);

        Swal.fire({
          title: "Memproses data...",
          html: progressContainer,
          showConfirmButton: false
        });

        var xhr = new XMLHttpRequest();
        xhr.open('POST', "{{ route('employ.externalimport') }}", true);
        xhr.upload.addEventListener("progress", function (e) {
          if (e.lengthComputable) {
            var percentage = Math.round((e.loaded / e.total) * 100);
            progressDiv.find('.progress-bar').width(percentage + '%');
            percentageText.text(percentage + '%');
          }
        });

        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              $('input[name="file"]').val('');
              Swal.fire({
                title: "Sukses!",
                text: "Data karyawan External berhasil diimport!",
                icon: "success",
              }).then((result) => {
                location.reload();
              });
            } else {
              $('input[name="file"]').val('');
              Swal.fire({
                title: "Error!",
                text: "Terjadi kesalahan saat mengimpor data.",
                icon: "error",
              });
            }
          }
        };

        xhr.send(formData);
      }
    });
  });
});

</script>

<script>
//Import Internal
//   $(document).ready(function () {
//       $('#form2').submit(function (event) {
//             event.preventDefault();
//             var formData = new FormData(this);
//             var inputFile = $('input[name="fileimportinter"]')[0].files[0];
//             if (!inputFile) {
//                 Swal.fire({
//                     title: "Error!",
//                     text: "Silakan pilih file untuk diunggah.",
//                     icon: "error",
//                 });
//                 return false;
//             }
//             Swal.fire({
//                 title: 'Apakah Anda yakin ingin mengimpor data karyawan Internal ?',
//                 text: "Anda tidak dapat mengembalikan data yang telah diimpor!",
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonColor: '#3085d6',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText: 'Ya, Impor!',
//                 cancelButtonText: 'Batal'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     var spinner = $('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
//                     Swal.fire({
//                     title: "Memproses data...",
//                     html: spinner,
//                     showConfirmButton: false
//                     });

//                     $.ajax({
//                         url: "{{ route('import') }}",
//                         type: "POST",
//                         data: formData,
//                         processData: false,
//                         contentType: false,
//                         success: function (response) {
//                             $('input[name="fileimportinter"]').val('');
//                             Swal.fire({
//                                 title: "Sukses!",
//                                 text: "Data karyawan Internal berhasil diimport!",
//                                 icon: "success",
//                             }).then((result) => {
//                                 location.reload();
//                             });
//                         },
//                         error: function (response) {
//                             $('input[name="fileimportinter"]').val('');
//                             Swal.fire({
//                                 title: "Error!",
//                                 text: response.responseJSON.message,
//                                 icon: "error",
//                             });
//                         },
//                         complete: function () {
//                         spinner.remove();
//                         }
//                     });
//                 }
//             });
//         });
//     });


$(document).ready(function () {
  $('#form2').submit(function (event) {
    event.preventDefault();
    var formData = new FormData(this);
    var inputFile = $('input[name="fileimportinter"]')[0].files[0];
    if (!inputFile) {
      Swal.fire({
        title: "Error!",
        text: "Silakan pilih file untuk diunggah.",
        icon: "error",
      });
      return false;
    }
    Swal.fire({
      title: 'Apakah Anda yakin ingin mengimpor data karyawan Internal ?',
      text: "Anda tidak dapat mengembalikan data yang telah diimpor!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Impor!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        var spinner = $('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
        var progressDiv = $('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div></div>');
        var percentageText = $('<div class="percentage-text">0%</div>');

        var progressContainer = $('<div class="progress-container"></div>');
        progressContainer.append(progressDiv);
        progressContainer.append(percentageText);

        Swal.fire({
          title: "Memproses data...",
          html: progressContainer,
          showConfirmButton: false
        });

        $.ajax({
          url: "{{ route('import') }}",
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (e) {
              if (e.lengthComputable) {
                var percentage = Math.round((e.loaded / e.total) * 100);
                progressDiv.find('.progress-bar').width(percentage + '%');
                percentageText.text(percentage + '%');
              }
            });
            return xhr;
          },
          success: function (response) {
            $('input[name="fileimportinter"]').val('');
            Swal.fire({
              title: "Sukses!",
              text: "Data karyawan Internal berhasil diimport!",
              icon: "success",
            }).then((result) => {
              location.reload();
            });
          },
          error: function (response) {
            $('input[name="fileimportinter"]').val('');
            Swal.fire({
              title: "Error!",
              text: response.responseJSON.message,
              icon: "error",
            });
          },
          complete: function () {
            spinner.remove();
          }
        });
      }
    });
  });
});


</script>



<script>
//Edit External
    // $(document).ready(function () {
    //     $('#form3').submit(function (event) {
    //         event.preventDefault();
    //         try {
    //             var formData = new FormData(this);
    //             var inputFile = $('input[name="fileeditexternal"]')[0].files[0];
    //             if (!inputFile) {
    //                 throw "Silakan pilih file untuk diunggah.";
    //             }
    //             Swal.fire({
    //                 title: 'Apakah Anda yakin ingin mengimpor data karyawan?',
    //                 text: "Anda tidak dapat mengembalikan data yang telah diimpor!",
    //                 icon: 'warning',
    //                 showCancelButton: true,
    //                 confirmButtonColor: '#3085d6',
    //                 cancelButtonColor: '#d33',
    //                 confirmButtonText: 'Ya, Impor!',
    //                 cancelButtonText: 'Batal'
    //             }).then((result) => {
    //                 if (result.isConfirmed) {
    //                     var spinner = $('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
    //                     Swal.fire({
    //                     title: "Memproses data...",
    //                     html: spinner,
    //                     showConfirmButton: false
    //                     });

    //                     $.ajax({
    //                         url: "{{ route('employ.editbulkkaryawanexternal') }}",
    //                         type: "POST",
    //                         data: formData,
    //                         processData: false,
    //                         contentType: false,
    //                         success: function (response) {
    //                             $('input[name="fileeditexternal"]').val('');
    //                             try {
    //                                 Swal.fire({
    //                                     title: "Sukses!",
    //                                     text: "Data karyawan berhasil diimport!",
    //                                     icon: "success",
    //                                 }).then((result) => {
    //                                     location.reload();
    //                                 });
    //                             } catch (e) {
    //                                 console.log(e);
    //                             }
    //                         },
    //                         error: function (response) {
    //                             $('input[name="fileeditexternal"]').val('');
    //                             try {
    //                                 Swal.fire({
    //                                     title: "Error!",
    //                                     text: response.responseJSON.message,
    //                                     icon: "error",
    //                                 });
    //                             } catch (e) {
    //                                 console.log(e);
    //                             }
    //                         },
    //                         complete: function () {
    //                     spinner.remove();
    //                     }
    //                     });
    //                 }
    //             });
    //         } catch (e) {
    //             $('input[name="fileeditexternal"]').val('');
    //             Swal.fire({
    //                 title: "Error!",
    //                 text: e,
    //                 icon: "error",
    //             });
    //         }
    //     });
    // });

    $(document).ready(function () {
  $('#form3').submit(function (event) {
    event.preventDefault();
    try {
      var formData = new FormData(this);
      var inputFile = $('input[name="fileeditexternal"]')[0].files[0];
      if (!inputFile) {
        throw "Silakan pilih file untuk diunggah.";
      }
      Swal.fire({
        title: 'Apakah Anda yakin ingin mengimpor data karyawan?',
        text: "Anda tidak dapat mengembalikan data yang telah diimpor!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Impor!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          var spinner = $('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
          var progressDiv = $('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div></div>');
          var percentageText = $('<div class="percentage-text">0%</div>');

          var progressContainer = $('<div class="progress-container"></div>');
          progressContainer.append(progressDiv);
          progressContainer.append(percentageText);

          Swal.fire({
            title: "Memproses data...",
            html: progressContainer,
            showConfirmButton: false
          });

          $.ajax({
            url: "{{ route('employ.editbulkkaryawanexternal') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
              var xhr = new window.XMLHttpRequest();
              xhr.upload.addEventListener("progress", function (e) {
                if (e.lengthComputable) {
                  var percentage = Math.round((e.loaded / e.total) * 100);
                  progressDiv.find('.progress-bar').width(percentage + '%');
                  percentageText.text(percentage + '%');
                }
              });
              return xhr;
            },
            success: function (response) {
              $('input[name="fileeditexternal"]').val('');
              try {
                Swal.fire({
                  title: "Sukses!",
                  text: "Data karyawan berhasil diimport!",
                  icon: "success",
                }).then((result) => {
                  location.reload();
                });
              } catch (e) {
                console.log(e);
              }
            },
            error: function (response) {
              $('input[name="fileeditexternal"]').val('');
              try {
                Swal.fire({
                  title: "Error!",
                  text: response.responseJSON.message,
                  icon: "error",
                });
              } catch (e) {
                console.log(e);
              }
            }
          });
        }
      });
    } catch (e) {
      $('input[name="fileeditexternal"]').val('');
      Swal.fire({
        title: "Error!",
        text: e,
        icon: "error",
      });
    }
  });
});

</script>

<script>
//Edit Internal
// $(document).ready(function () {
//         $('#form4').submit(function (event) {
//             event.preventDefault();
//             try {
//                 var formData = new FormData(this);
//                 var inputFile = $('input[name="fileeditinternal"]')[0].files[0];
//                 if (!inputFile) {
//                     throw "Silakan pilih file untuk diunggah.";
//                 }
//                 Swal.fire({
//                     title: 'Apakah Anda yakin ingin mengimpor data karyawan Internal?',
//                     text: "Anda tidak dapat mengembalikan data yang telah diimpor!",
//                     icon: 'warning',
//                     showCancelButton: true,
//                     confirmButtonColor: '#3085d6',
//                     cancelButtonColor: '#d33',
//                     confirmButtonText: 'Ya, Impor!',
//                     cancelButtonText: 'Batal'
//                 }).then((result) => {
//                     if (result.isConfirmed) {
//                         var spinner = $('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
//                         Swal.fire({
//                         title: "Memproses data...",
//                         html: spinner,
//                         showConfirmButton: false
//                         });
//                         $.ajax({
//                             url: "{{ route('employ.editbulkkaryawaninternal') }}",
//                             type: "POST",
//                             data: formData,
//                             processData: false,
//                             contentType: false,
//                             success: function (response) {
//                                 try {
//                                     Swal.fire({
//                                         title: "Sukses!",
//                                         text: "Data karyawan Internal berhasil diimport!",
//                                         icon: "success",
//                                     }).then((result) => {
//                                         location.reload();
//                                         $('input[name="fileeditinternal"]').val('');
//                                     });
//                                 } catch (e) {
//                                     console.log(e);
//                                 }
//                             },
//                             error: function (response) {
//                                 try {
//                                     Swal.fire({
//                                         title: "Error!",
//                                         text: response.responseJSON.message,
//                                         icon: "error",
//                                     });
//                                 } catch (e) {
//                                     console.log(e);
// 			                    }
//                                 $('input[name="fileeditinternal"]').val('');
//                             },

//                             complete: function () {
//                         spinner.remove();
//                         }
//                         });
//                     }
//                 });
//             } 
//             catch (e) {
//                 Swal.fire({
//                     title: "Error!",
//                     text: e,
//                     icon: "error",
//                 });
//                 $('input[name="fileeditinternal"]').val('');
//             }
//         });
//     });

$(document).ready(function () {
  $('#form4').submit(function (event) {
    event.preventDefault();
    try {
      var formData = new FormData(this);
      var inputFile = $('input[name="fileeditinternal"]')[0].files[0];
      if (!inputFile) {
        throw "Silakan pilih file untuk diunggah.";
      }
      Swal.fire({
        title: 'Apakah Anda yakin ingin mengimpor data karyawan Internal?',
        text: "Anda tidak dapat mengembalikan data yang telah diimpor!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Impor!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          var spinner = $('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
          var progressDiv = $('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div></div>');
          var percentageText = $('<div class="percentage-text">0%</div>');

          var progressContainer = $('<div class="progress-container"></div>');
          progressContainer.append(progressDiv);
          progressContainer.append(percentageText);

          Swal.fire({
            title: "Memproses data...",
            html: progressContainer,
            showConfirmButton: false
          });

          $.ajax({
            url: "{{ route('employ.editbulkkaryawaninternal') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
              var xhr = new window.XMLHttpRequest();
              xhr.upload.addEventListener("progress", function (e) {
                if (e.lengthComputable) {
                  var percentage = Math.round((e.loaded / e.total) * 100);
                  progressDiv.find('.progress-bar').width(percentage + '%');
                  percentageText.text(percentage + '%');
                }
              });
              return xhr;
            },
            success: function (response) {
              try {
                Swal.fire({
                  title: "Sukses!",
                  text: "Data karyawan Internal berhasil diimport!",
                  icon: "success",
                }).then((result) => {
                  location.reload();
                  $('input[name="fileeditinternal"]').val('');
                });
              } catch (e) {
                console.log(e);
              }
            },
            error: function (response) {
              try {
                Swal.fire({
                  title: "Error!",
                  text: response.responseJSON.message,
                  icon: "error",
                });
              } catch (e) {
                console.log(e);
              }
              $('input[name="fileeditinternal"]').val('');
            }
          });
        }
      });
    } catch (e) {
      Swal.fire({
        title: "Error!",
        text: e,
        icon: "error",
      });
      $('input[name="fileeditinternal"]').val('');
    }
  });
});

</script>
