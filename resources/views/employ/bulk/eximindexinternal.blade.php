@extends('layouts.app-master')
@section('content-employ')


<div class="employ-bulk">
  <div class="container">
    <div class="row">
      <div class="head-title col-md-6">
        <h5 class="title-employ">Bulk Employees</h5>
      </div>
    </div>
  </div>
</div>

<div class="body mt-5">
  <div class="container">
    <div class="row row-cols-2 ">
      <div class="body-bulk import col d-flex justify-content-start">
        <div class="text-head">Import Bulk Employee Internal</div>
        <div class="div">
          <div class="div-2">
            <a href="/employ/exportinternal" class="btn btn-sm text-wrapper-2" data-toggle="tooltip" data-placement="top" title="Format Data External">
              Download Tamplate
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 35 35" fill="none">
                <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M4.45526 20.7378C5.05564 20.7378 5.54235 21.2245 5.54235 21.8249C5.54235 23.9054 5.54466 25.3565 5.69187 26.4514C5.83486 27.515 6.09641 28.0781 6.49756 28.4794C6.89872 28.8806 7.46195 29.142 8.52552 29.2851C9.62037 29.4322 11.0714 29.4345 13.152 29.4345H21.8488C23.9293 29.4345 25.3804 29.4322 26.4753 29.2851C27.5389 29.142 28.102 28.8806 28.5032 28.4794C28.9045 28.0781 29.1659 27.515 29.309 26.4514C29.4561 25.3565 29.4584 23.9054 29.4584 21.8249C29.4584 21.2245 29.9452 20.7378 30.5455 20.7378C31.1459 20.7378 31.6326 21.2245 31.6326 21.8249V21.9045C31.6326 23.8867 31.6326 25.4845 31.4638 26.7412C31.2884 28.0458 30.9131 29.1442 30.0407 30.0167C29.1681 30.8892 28.0697 31.2645 26.7651 31.4399C25.5084 31.6087 23.9106 31.6087 21.9284 31.6087H13.0725C11.0902 31.6087 9.49245 31.6087 8.23581 31.4399C6.93114 31.2645 5.83264 30.8892 4.96018 30.0168C4.08772 29.1442 3.71247 28.0458 3.53706 26.7412C3.36811 25.4845 3.36814 23.8867 3.36816 21.9045C3.36816 21.8779 3.36816 21.8514 3.36816 21.8249C3.36816 21.2245 3.85488 20.7378 4.45526 20.7378Z" fill="#338A2C" fill-opacity="0.5"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5008 24.3618C17.1956 24.3618 16.9045 24.2335 16.6985 24.0083L10.9007 17.6669C10.4956 17.2238 10.5263 16.5362 10.9694 16.131C11.4125 15.7259 12.1001 15.7567 12.5052 16.1998L16.4137 20.4747L16.4137 4.43175C16.4137 3.83138 16.9004 3.34465 17.5008 3.34465C18.1012 3.34465 18.5879 3.83138 18.5879 4.43175L18.5879 20.4747L22.4963 16.1998C22.9015 15.7567 23.5891 15.7259 24.0322 16.131C24.4753 16.5362 24.5061 17.2238 24.101 17.6669L18.3031 24.0083C18.0971 24.2335 17.8061 24.3618 17.5008 24.3618Z" fill="#338A2C"/>
              </svg>
            </a>         
          </div>
          <div class="div-3">
            <div class="div-4">
              <p class="p">File should be an Excel</p>
              <div  class="col form-svgrepo-com" >
                <div class="overlap-group">
                  <svg width="30" height="30" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.9369 9.98087H30.6099C30.709 9.98364 30.8077 9.96615 30.8999 9.92948C30.992 9.89281 31.0757 9.83772 31.1459 9.76758C31.216 9.69745 31.2711 9.61374 31.3077 9.52159C31.3444 9.42943 31.3619 9.33076 31.3591 9.23161C31.3656 9.13209 31.3497 9.03238 31.3127 8.93978C31.2757 8.84718 31.2184 8.76404 31.1451 8.69643L24.0806 1.63199C24.013 1.55867 23.9299 1.50139 23.8373 1.46435C23.7447 1.42731 23.645 1.41144 23.5454 1.41791C23.4463 1.41514 23.3476 1.43263 23.2555 1.4693C23.1633 1.50598 23.0796 1.56107 23.0095 1.6312C22.9393 1.70134 22.8842 1.78504 22.8476 1.8772C22.8109 1.96936 22.7934 2.06802 22.7962 2.16717V7.84013C22.7979 8.40735 23.0241 8.95083 23.4251 9.35192C23.8262 9.753 24.3697 9.97911 24.9369 9.98087Z" fill="#9E9E9E"/>
                    <path d="M30.2895 13.192H22.7969C21.9458 13.1903 21.1301 12.8514 20.5282 12.2496C19.9264 11.6478 19.5875 10.832 19.5858 9.98093V2.48834C19.5858 2.20446 19.473 1.93221 19.2723 1.73147C19.0715 1.53074 18.7993 1.41797 18.5154 1.41797H7.8117C6.9606 1.41974 6.14487 1.75862 5.54305 2.36043C4.94123 2.96225 4.60235 3.77798 4.60059 4.62908V30.318C4.60235 31.1691 4.94123 31.9848 5.54305 32.5866C6.14487 33.1884 6.9606 33.5273 7.8117 33.5291H28.1487C28.9998 33.5273 29.8156 33.1884 30.4174 32.5866C31.0192 31.9848 31.3581 31.1691 31.3598 30.318V14.2624C31.3598 14.1218 31.3322 13.9827 31.2784 13.8528C31.2246 13.7229 31.1457 13.6049 31.0463 13.5055C30.9469 13.4062 30.8289 13.3273 30.6991 13.2735C30.5692 13.2197 30.43 13.192 30.2895 13.192ZM8.88207 12.1217C8.89403 11.8447 9.01165 11.5829 9.21074 11.39C9.40983 11.1972 9.67526 11.0879 9.95244 11.0848H14.3343C14.4713 11.0839 14.6072 11.11 14.7341 11.1616C14.8611 11.2133 14.9766 11.2894 15.0742 11.3857C15.1717 11.482 15.2493 11.5965 15.3026 11.7228C15.3558 11.8491 15.3837 11.9846 15.3846 12.1217V13.1854C15.3761 13.4641 15.2611 13.7291 15.0632 13.9257C14.8654 14.1223 14.5997 14.2356 14.3209 14.2423H9.95244C9.81288 14.2451 9.67421 14.2196 9.54474 14.1674C9.41527 14.1153 9.29766 14.0375 9.19896 13.9388C9.10026 13.8401 9.0225 13.7225 8.97035 13.5931C8.91819 13.4636 8.89272 13.3249 8.89545 13.1854L8.88207 12.1217ZM24.9376 26.0164C24.9376 26.3003 24.8248 26.5725 24.6241 26.7733C24.4234 26.974 24.1511 27.0868 23.8672 27.0868H9.95244C9.66856 27.0868 9.3963 26.974 9.19557 26.7733C8.99484 26.5725 8.88207 26.3003 8.88207 26.0164V24.9661C8.88207 24.6822 8.99484 24.41 9.19557 24.2092C9.3963 24.0085 9.66856 23.8957 9.95244 23.8957H23.8672C24.1511 23.8957 24.4234 24.0085 24.6241 24.2092C24.8248 24.41 24.9376 24.6822 24.9376 24.9661V26.0164ZM27.0784 19.5942C27.081 19.7364 27.0553 19.8778 27.0027 20.01C26.9501 20.1422 26.8717 20.2625 26.772 20.3641C26.6724 20.4656 26.5535 20.5462 26.4223 20.6013C26.2911 20.6563 26.1503 20.6847 26.008 20.6846H9.95244C9.66856 20.6846 9.3963 20.5719 9.19557 20.3711C8.99484 20.1704 8.88207 19.8981 8.88207 19.6143V18.5439C8.88207 18.26 8.99484 17.9878 9.19557 17.787C9.3963 17.5863 9.66856 17.4735 9.95244 17.4735H26.008C26.2919 17.4735 26.5641 17.5863 26.7649 17.787C26.9656 17.9878 27.0784 18.26 27.0784 18.5439V19.5942Z" fill="#E0E0E0"/>
                    <rect x="12.6865" y="18.2295" width="21.931" height="12.8561" rx="3.66179" fill="#34A201"/>
                    <path d="M14.7329 27.1577L16.5125 24.3894L14.7768 21.7016H15.5971L17.0691 23.9939H16.7615L18.2336 21.7016H19.0538L17.3181 24.3894L19.0978 27.1577H18.2775L16.7615 24.7849H17.0691L15.5458 27.1577H14.7329ZM19.7874 27.1577V21.7016H20.5051V26.4986H22.8999V27.1577H19.7874ZM25.5815 27.2456C25.2348 27.2456 24.9175 27.1821 24.6294 27.0552C24.3414 26.9234 24.0972 26.7452 23.8971 26.5206C23.6969 26.296 23.5528 26.0445 23.465 25.7662L24.0875 25.5099C24.2193 25.8614 24.4146 26.1324 24.6734 26.3228C24.937 26.5084 25.2446 26.6011 25.5961 26.6011C25.811 26.6011 25.9989 26.5669 26.16 26.4986C26.3212 26.4302 26.4457 26.335 26.5335 26.213C26.6263 26.086 26.6727 25.9396 26.6727 25.7736C26.6727 25.5441 26.6068 25.3634 26.475 25.2316C26.348 25.0949 26.16 24.9924 25.911 24.924L24.9077 24.6164C24.5122 24.4944 24.2095 24.3015 23.9996 24.0379C23.7896 23.7742 23.6847 23.4715 23.6847 23.1297C23.6847 22.8319 23.7555 22.5707 23.8971 22.3461C24.0435 22.1166 24.2437 21.9384 24.4976 21.8115C24.7564 21.6797 25.0493 21.6138 25.3764 21.6138C25.7035 21.6138 25.9989 21.6723 26.2626 21.7895C26.5311 21.9067 26.7581 22.0654 26.9437 22.2656C27.1292 22.4609 27.2659 22.6854 27.3538 22.9393L26.7386 23.1957C26.6214 22.8881 26.4457 22.6562 26.2113 22.4999C25.977 22.3388 25.7011 22.2582 25.3837 22.2582C25.1884 22.2582 25.0151 22.2924 24.8638 22.3608C24.7173 22.4242 24.6026 22.5194 24.5196 22.6464C24.4414 22.7684 24.4024 22.9149 24.4024 23.0858C24.4024 23.286 24.4659 23.4642 24.5928 23.6204C24.7197 23.7767 24.9126 23.8963 25.1714 23.9793L26.0868 24.2503C26.5165 24.3821 26.8411 24.57 27.0608 24.8142C27.2806 25.0583 27.3904 25.361 27.3904 25.7223C27.3904 26.0201 27.3123 26.2838 27.1561 26.5132C27.0047 26.7427 26.7923 26.9234 26.5189 27.0552C26.2504 27.1821 25.9379 27.2456 25.5815 27.2456ZM27.9139 27.1577L29.6936 24.3894L27.9579 21.7016H28.7781L30.2502 23.9939H29.9426L31.4146 21.7016H32.2348L30.4992 24.3894L32.2788 27.1577H31.4585L29.9426 24.7849H30.2502L28.7268 27.1577H27.9139Z" fill="white"/>
                  </svg>
                  <div class="div-wrapper"><div class="text-wrapper-3">XLSX</div></div>
                </div>
              </div>
            </div>
            <form id='form2' action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
              @CSRF 
              <div class="div-5" >
                <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control form-control-sm col-form-input" name="fileimportinter">
              </div>
              <button type="submit" class="btn btn-primary div-wrapper-3 text-wrapper-5 mt-3">Submit</button>
            </form>
          </div>
        </div>
      </div>

      <div class="body-bulk edit col d-flex justify-content-end">
        <div class="text-head">Edit Bulk Employee Internal</div>
        <div class="div">
          <div class="div-2">
            <button type="button" class="btn btn-sm text-wrapper-2" data-toggle="modal" data-target="#modaleditinternal">
              Download Tamplate
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 35 35" fill="none">
                <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M4.45526 20.7378C5.05564 20.7378 5.54235 21.2245 5.54235 21.8249C5.54235 23.9054 5.54466 25.3565 5.69187 26.4514C5.83486 27.515 6.09641 28.0781 6.49756 28.4794C6.89872 28.8806 7.46195 29.142 8.52552 29.2851C9.62037 29.4322 11.0714 29.4345 13.152 29.4345H21.8488C23.9293 29.4345 25.3804 29.4322 26.4753 29.2851C27.5389 29.142 28.102 28.8806 28.5032 28.4794C28.9045 28.0781 29.1659 27.515 29.309 26.4514C29.4561 25.3565 29.4584 23.9054 29.4584 21.8249C29.4584 21.2245 29.9452 20.7378 30.5455 20.7378C31.1459 20.7378 31.6326 21.2245 31.6326 21.8249V21.9045C31.6326 23.8867 31.6326 25.4845 31.4638 26.7412C31.2884 28.0458 30.9131 29.1442 30.0407 30.0167C29.1681 30.8892 28.0697 31.2645 26.7651 31.4399C25.5084 31.6087 23.9106 31.6087 21.9284 31.6087H13.0725C11.0902 31.6087 9.49245 31.6087 8.23581 31.4399C6.93114 31.2645 5.83264 30.8892 4.96018 30.0168C4.08772 29.1442 3.71247 28.0458 3.53706 26.7412C3.36811 25.4845 3.36814 23.8867 3.36816 21.9045C3.36816 21.8779 3.36816 21.8514 3.36816 21.8249C3.36816 21.2245 3.85488 20.7378 4.45526 20.7378Z" fill="#338A2C" fill-opacity="0.5"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5008 24.3618C17.1956 24.3618 16.9045 24.2335 16.6985 24.0083L10.9007 17.6669C10.4956 17.2238 10.5263 16.5362 10.9694 16.131C11.4125 15.7259 12.1001 15.7567 12.5052 16.1998L16.4137 20.4747L16.4137 4.43175C16.4137 3.83138 16.9004 3.34465 17.5008 3.34465C18.1012 3.34465 18.5879 3.83138 18.5879 4.43175L18.5879 20.4747L22.4963 16.1998C22.9015 15.7567 23.5891 15.7259 24.0322 16.131C24.4753 16.5362 24.5061 17.2238 24.101 17.6669L18.3031 24.0083C18.0971 24.2335 17.8061 24.3618 17.5008 24.3618Z" fill="#338A2C"/>
              </svg>
            </button>
          </div>
          <div class="div-3">
            <div class="div-4">
              <p class="p">File should be an Excel</p>
              <div  class="col form-svgrepo-com" >
                <div class="overlap-group">
                  <svg width="30" height="30" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.9369 9.98087H30.6099C30.709 9.98364 30.8077 9.96615 30.8999 9.92948C30.992 9.89281 31.0757 9.83772 31.1459 9.76758C31.216 9.69745 31.2711 9.61374 31.3077 9.52159C31.3444 9.42943 31.3619 9.33076 31.3591 9.23161C31.3656 9.13209 31.3497 9.03238 31.3127 8.93978C31.2757 8.84718 31.2184 8.76404 31.1451 8.69643L24.0806 1.63199C24.013 1.55867 23.9299 1.50139 23.8373 1.46435C23.7447 1.42731 23.645 1.41144 23.5454 1.41791C23.4463 1.41514 23.3476 1.43263 23.2555 1.4693C23.1633 1.50598 23.0796 1.56107 23.0095 1.6312C22.9393 1.70134 22.8842 1.78504 22.8476 1.8772C22.8109 1.96936 22.7934 2.06802 22.7962 2.16717V7.84013C22.7979 8.40735 23.0241 8.95083 23.4251 9.35192C23.8262 9.753 24.3697 9.97911 24.9369 9.98087Z" fill="#9E9E9E"/>
                    <path d="M30.2895 13.192H22.7969C21.9458 13.1903 21.1301 12.8514 20.5282 12.2496C19.9264 11.6478 19.5875 10.832 19.5858 9.98093V2.48834C19.5858 2.20446 19.473 1.93221 19.2723 1.73147C19.0715 1.53074 18.7993 1.41797 18.5154 1.41797H7.8117C6.9606 1.41974 6.14487 1.75862 5.54305 2.36043C4.94123 2.96225 4.60235 3.77798 4.60059 4.62908V30.318C4.60235 31.1691 4.94123 31.9848 5.54305 32.5866C6.14487 33.1884 6.9606 33.5273 7.8117 33.5291H28.1487C28.9998 33.5273 29.8156 33.1884 30.4174 32.5866C31.0192 31.9848 31.3581 31.1691 31.3598 30.318V14.2624C31.3598 14.1218 31.3322 13.9827 31.2784 13.8528C31.2246 13.7229 31.1457 13.6049 31.0463 13.5055C30.9469 13.4062 30.8289 13.3273 30.6991 13.2735C30.5692 13.2197 30.43 13.192 30.2895 13.192ZM8.88207 12.1217C8.89403 11.8447 9.01165 11.5829 9.21074 11.39C9.40983 11.1972 9.67526 11.0879 9.95244 11.0848H14.3343C14.4713 11.0839 14.6072 11.11 14.7341 11.1616C14.8611 11.2133 14.9766 11.2894 15.0742 11.3857C15.1717 11.482 15.2493 11.5965 15.3026 11.7228C15.3558 11.8491 15.3837 11.9846 15.3846 12.1217V13.1854C15.3761 13.4641 15.2611 13.7291 15.0632 13.9257C14.8654 14.1223 14.5997 14.2356 14.3209 14.2423H9.95244C9.81288 14.2451 9.67421 14.2196 9.54474 14.1674C9.41527 14.1153 9.29766 14.0375 9.19896 13.9388C9.10026 13.8401 9.0225 13.7225 8.97035 13.5931C8.91819 13.4636 8.89272 13.3249 8.89545 13.1854L8.88207 12.1217ZM24.9376 26.0164C24.9376 26.3003 24.8248 26.5725 24.6241 26.7733C24.4234 26.974 24.1511 27.0868 23.8672 27.0868H9.95244C9.66856 27.0868 9.3963 26.974 9.19557 26.7733C8.99484 26.5725 8.88207 26.3003 8.88207 26.0164V24.9661C8.88207 24.6822 8.99484 24.41 9.19557 24.2092C9.3963 24.0085 9.66856 23.8957 9.95244 23.8957H23.8672C24.1511 23.8957 24.4234 24.0085 24.6241 24.2092C24.8248 24.41 24.9376 24.6822 24.9376 24.9661V26.0164ZM27.0784 19.5942C27.081 19.7364 27.0553 19.8778 27.0027 20.01C26.9501 20.1422 26.8717 20.2625 26.772 20.3641C26.6724 20.4656 26.5535 20.5462 26.4223 20.6013C26.2911 20.6563 26.1503 20.6847 26.008 20.6846H9.95244C9.66856 20.6846 9.3963 20.5719 9.19557 20.3711C8.99484 20.1704 8.88207 19.8981 8.88207 19.6143V18.5439C8.88207 18.26 8.99484 17.9878 9.19557 17.787C9.3963 17.5863 9.66856 17.4735 9.95244 17.4735H26.008C26.2919 17.4735 26.5641 17.5863 26.7649 17.787C26.9656 17.9878 27.0784 18.26 27.0784 18.5439V19.5942Z" fill="#E0E0E0"/>
                    <rect x="12.6865" y="18.2295" width="21.931" height="12.8561" rx="3.66179" fill="#34A201"/>
                    <path d="M14.7329 27.1577L16.5125 24.3894L14.7768 21.7016H15.5971L17.0691 23.9939H16.7615L18.2336 21.7016H19.0538L17.3181 24.3894L19.0978 27.1577H18.2775L16.7615 24.7849H17.0691L15.5458 27.1577H14.7329ZM19.7874 27.1577V21.7016H20.5051V26.4986H22.8999V27.1577H19.7874ZM25.5815 27.2456C25.2348 27.2456 24.9175 27.1821 24.6294 27.0552C24.3414 26.9234 24.0972 26.7452 23.8971 26.5206C23.6969 26.296 23.5528 26.0445 23.465 25.7662L24.0875 25.5099C24.2193 25.8614 24.4146 26.1324 24.6734 26.3228C24.937 26.5084 25.2446 26.6011 25.5961 26.6011C25.811 26.6011 25.9989 26.5669 26.16 26.4986C26.3212 26.4302 26.4457 26.335 26.5335 26.213C26.6263 26.086 26.6727 25.9396 26.6727 25.7736C26.6727 25.5441 26.6068 25.3634 26.475 25.2316C26.348 25.0949 26.16 24.9924 25.911 24.924L24.9077 24.6164C24.5122 24.4944 24.2095 24.3015 23.9996 24.0379C23.7896 23.7742 23.6847 23.4715 23.6847 23.1297C23.6847 22.8319 23.7555 22.5707 23.8971 22.3461C24.0435 22.1166 24.2437 21.9384 24.4976 21.8115C24.7564 21.6797 25.0493 21.6138 25.3764 21.6138C25.7035 21.6138 25.9989 21.6723 26.2626 21.7895C26.5311 21.9067 26.7581 22.0654 26.9437 22.2656C27.1292 22.4609 27.2659 22.6854 27.3538 22.9393L26.7386 23.1957C26.6214 22.8881 26.4457 22.6562 26.2113 22.4999C25.977 22.3388 25.7011 22.2582 25.3837 22.2582C25.1884 22.2582 25.0151 22.2924 24.8638 22.3608C24.7173 22.4242 24.6026 22.5194 24.5196 22.6464C24.4414 22.7684 24.4024 22.9149 24.4024 23.0858C24.4024 23.286 24.4659 23.4642 24.5928 23.6204C24.7197 23.7767 24.9126 23.8963 25.1714 23.9793L26.0868 24.2503C26.5165 24.3821 26.8411 24.57 27.0608 24.8142C27.2806 25.0583 27.3904 25.361 27.3904 25.7223C27.3904 26.0201 27.3123 26.2838 27.1561 26.5132C27.0047 26.7427 26.7923 26.9234 26.5189 27.0552C26.2504 27.1821 25.9379 27.2456 25.5815 27.2456ZM27.9139 27.1577L29.6936 24.3894L27.9579 21.7016H28.7781L30.2502 23.9939H29.9426L31.4146 21.7016H32.2348L30.4992 24.3894L32.2788 27.1577H31.4585L29.9426 24.7849H30.2502L28.7268 27.1577H27.9139Z" fill="white"/>
                  </svg>
                  <div class="div-wrapper"><div class="text-wrapper-3">XLSX</div></div>
                </div>
              </div>
            </div>
            <form id='form4' action="{{ route('employ.editbulkkaryawaninternal') }}" method="POST" enctype="multipart/form-data">
              @CSRF 
              <div class="div-5" >
                <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control form-control-sm col-form-input" name="fileeditinternal">
              </div>
              <button type="submit" class="btn btn-primary div-wrapper-3 text-wrapper-5 mt-3">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal edit internal -->
<div class="modal fade" id="modaleditinternal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filter Pencarian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form untuk filter pencarian -->
        <form class="col" action="{{ route('employ.intetempbulkex') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="cabang">Pilih Cabang:</label>
                <input class="form-control" list="list-cabang" name="cabang[]" required>
		<datalist id="list-cabang">
                    @foreach($cabs as $cbg)
                        <option value="{{ $cbg->nama }}" data-value="{{ $cbg->id }}"></option>
                    @endforeach
                </datalist>
                <input type="hidden" name="cabang_id[]" value="">
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <input class="form-control" list="list-jabatan" name="jabatan[]" required>
		<datalist id="list-jabatan">
                        <option value="All" data-value="All"></option>
                    @foreach ($jabs as $jab)
                        <option value="{{ $jab->nama }}" data-value="{{ $jab->id }}"></option>
                    @endforeach
                </datalist>
                <input type="hidden" name="jabatan_id[]" value="">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
      </div>
    </div>
  </div>
</div>
@include('employ.partials.script_bulk')
<style>

.form-control {
    border-radius: 0;
    box-shadow: none;
    border-color: #d2d6de
}

.select2-hidden-accessible {
    border: 0 !important;
    clip: rect(0 0 0 0) !important;
    height: 1px !important;
    margin: -1px !important;
    overflow: hidden !important;
    padding: 0 !important;
    position: absolute !important;
    width: 1px !important
}

.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
}

.select2-container--default .select2-selection--single,
.select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0;
    padding: 6px 12px;
    height: 34px
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px
}

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 28px;
    user-select: none;
    -webkit-user-select: none
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-right: 10px
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 0;
    padding-right: 0;
    height: auto;
    margin-top: -3px
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px
}

.select2-container--default .select2-selection--single,
.select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0 !important;
    padding: 6px 12px;
    height: 40px !important
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 6px !important;
    right: 1px;
    width: 20px
}


.alert-box {
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
}

.card-container {
	display: flex;
	justify-content: center;	
	margin-top: 20px;
}
.card {
	height: 150px;
	width:  300px;
	display: inline-flex;
	justify-content: center;
	text-decoration: none;
  position: relative;
}
.card-top {
	border-radius: 8px;
    width: 307px;
    background: white;
    height: 150px;
    margin-left: -6px;
    position: absolute;
    z-index: 8;
    transition: transform .5s;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
.card-top1 {
	border-radius: 8px;
    width: 307px;
    background: white;
    height: 150px;
    margin-left: -6px;
    position: absolute;
    z-index: 8;
    transition: transform .5s;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}

.card1 {
	/* background: url('https://www.questionpro.com/blog/wp-content/uploads/2022/06/employee-involment.jpg');	 */
	background-size: cover;
	background-image: url("../assets/bootstrap/img/interkar.png");
	/* border: 3px ; */
	
}
.card2 {
	/* background: url('https://www.questionpro.com/blog/wp-content/uploads/2022/06/employee-involment.jpg');	 */
	background-size: cover;
	background-image: url("../assets/bootstrap/img/kareks.png");
	/* border: 3px ; */
	
}
.card3 {
	/* background: url('https://www.questionpro.com/blog/wp-content/uploads/2022/06/employee-involment.jpg');	 */
	background-size: cover;
	background-image: url("../assets/bootstrap/img/updateeks.png");
	/* border: 3px ; */
	
}
.card4 {
	/* background: url('https://www.questionpro.com/blog/wp-content/uploads/2022/06/employee-involment.jpg');	 */
	background-size: cover;
	background-image: url("../assets/bootstrap/img/updateinter.png");
	/* border: 3px ; */
	
}
.card:hover .card-top {
	transform: translatey(-165px);
  /* position: absolute; */

}
.card:hover .card-top1 {
	transform: translatey(165px);
  /* position: absolute; */

}
.card-bottom {
	background: #FAF9F6;
	width: 100%;
	height: 200px;
	border-radius: 8px;
}
.card-contents {
	color: black;
	display: flex;
	flex-direction: column;
	align-items: center;
}
.card-contents p{
	margin: 7px 0px;
}
.card-title {
	font-weight: bold;
	font-size: 1.3em;
}
</style>
@endsection
