@extends('theme::layouts.main')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="1111sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container-fluid stf_outer_body">
   <div class="row">
      <div class="col-lg-11 m-auto mt-3">
         <ul class="d-md-flex align-items-center female-style-menu text-nowrap overflow-auto p-3 justify-content-center">
            <li class="pr-4">
               <a class="menu-link" href="#">
               <i class="fa fa-solid fa-circle pr-2"></i>
               <span style="font-weight: 600;"> FEMALE FITTING</span>
               </a>
            </li>
            <li class="pr-4">
               <a class="menu-link" href="#">
               <i class="fal fa-regular fa-circle pr-2"></i>
               <span>BODY SHAPE AND FIT</span>
               </a>
            </li>
            <li class="pr-4">
               <a class="menu-link" href="#">
               <i class="fal fa-solid fa-circle pr-2"></i>
               <span>CURRENT PERSONAL STYLE</span>
               </a>
            </li>
            <li class="pr-4">
               <a class="menu-link" href="#">
               <i class="fal fa-solid fa-circle pr-2"></i>
               <span>CLOTHING STYLE AND FIT</span>
               </a>
            </li>
            <li class="pr-4">
               <a class="menu-link" href="#">
               <i class="fal fa-solid fa-circle pr-2"></i>
               <span>BODY SHAPE & FIT</span>
               </a>
            </li>
            <li class="pr-4">
               <a class="menu-link" href="#">
               <i class="fal fa-solid fa-circle pr-2"></i>
               <span>COLOUR AND FABRIC</span>
               </a>
            </li>
            <li class="pr-4">
               <a class="menu-link" href="#">
               <i class="fal fa-solid fa-circle pr-2"></i>
               <span>BUDGET</span>
               </a>
            </li>
         </ul>
         <section>
            <div class="container-fluid ">
               <div class="row my-md-5 align-items-center">
                  <div class="col-md-6 order-2 order-md-1 pt-3 pt-md-0" >
                     <div class="gett-text-p">
                        <h1>GETTING TO KNOW YOU</h1>
                        <h3>FEMALE FITTING</h3>
                        <p>Let us know what you believe best describes your proportions. Just to give you a heads up Marcia, we’ll be asking for a full length photo in this section. To style you we need to see you!</p>
                     </div>
                  </div>
                  <div class="col-md-6 gett-text-img p-0 order-1 order-md-2">
                     <img src="{{ url('images/stylist/15.png') }}" alt=""  style="width: 100%;">
                  </div>
               </div>               
            </div>
         </section>
         <section>
            <div class="container-fluid ">
               <div class="row my-md-5 align-items-center">
                  <div class="col-md-6 m-auto">
                     <div class="gett-text-ptw">
                        <h1>GETTING TO KNOW YOU</h1>
                        <p class="py-3 ">Let us know what you believe best describes your proportions. Just to give you a heads up Marcia, we’ll be asking for a full length photo in this section. To style you we need to see you!</p>
                        <input placeholder="Type your answer here" type="text" />
                        <p class="py-2 gett-text-pque">THIS QUESTION IS REQUIRED.*</p>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section>
            <div class="container-fluid ">
               <div class="row my-md-5 align-items-center">
                  <div class="col-md-6 m-auto">
                     <div class="gett-text-ptw">
                        <h1>What Is Your Weight In Kg?</h1>
                        <p class="py-3 ">We know this is a sensitive topic - your answer helps us build an accurate profile and is completely confidential and only shared with your stylist.</p>
                        <input placeholder="Type your answer here" type="text" />
                        <p class="py-2 gett-text-pque">THIS QUESTION IS REQUIRED.*</p>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section>
            <div class="container-fluid ">
               <div class="row my-md-5 align-items-center">
                  <div class="col-md-6 m-auto">
                    <div class="gett-text-dj"><h1>FEMALE SIZING</h1></div>
                     <div class="gett-text-ptw">
                        <h1>What Is Your Weight In Kg?</h1>
                        <p class="py-3">We know this is a sensitive topic - your answer helps us build an accurate profile and is completely confidential and only shared with your stylist.</p>
                        <p class="py-3" style="text-align: inherit;">PLEASE MAKE BETWEEN 1 AND 2 CHOICES. THIS QUESTION IS REQUIRED.*</p>
                        <span class="row">
                          <button type="button" class="btn btn-pr-style my-2 mr-3">4/XXS</button>    
                          <button type="button" class="btn btn-pr-style-tow my-2 mr-3">6/XS</button>    
                          <button type="button" class="btn btn-pr-style my-2 mr-3">8/S</button> 
                          <button type="button" class="btn btn-pr-style-tow  my-2 mr-3">12/L</button>    
                          <button type="button" class="btn btn-pr-style-tow my-2 mr-3">10/M</button>    
                          <button type="button" class="btn btn-pr-style-tow  my-2 mr-3">14/XL</button>  
                        </span>                 
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section>
            <div class="container-fluid ">
               <div class="row my-md-5 align-items-center">
                  <div class="col-md-6 m-auto">
                    <div class="gett-text-dj"><h1>FEMALE SIZING</h1></div>
                     <div class="gett-text-ptw">
                        <h1>How would you describe your foot?</h1>                        
                        <div class="input-group mb-3">  
                          <select class="form-select py-3 "  id="inputGroupSelect03" aria-label="Example select with button addon">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>                         
                        </div>   
                        <p class="py-3" style="text-align: inherit;">THIS QUESTION IS REQUIRED.*</p>                   
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section>
            <div class="container-fluid ">
               <div class="row my-md-5 align-items-center">
                  <div class="col-md-6 m-auto">
                     <div class="gett-text-ptw">
                        <h1>What Is Your Weight In Kg?</h1>
                        <p class="py-3 ">We know this is a sensitive topic - your answer helps us build an accurate profile and is completely confidential and only shared with your stylist.</p>
                        <input placeholder="Type your answer here" type="text" />
                        <p class="py-2 gett-text-pque">THIS QUESTION IS REQUIRED.*</p>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section>
            <div class="container-fluid ">
               <div class="row my-md-5 align-items-center">
                  <div class="col-md-6 order-2 order-md-1 pt-3 pt-md-0">
                     <div class="gett-text-ptw gett-text-ptw-two m-auto ">
                        <h1>What Is Your Weight In Kg?</h1>
                        <h3>FEMALE FITTING</h3>
                        <p class="py-3 ">We know this is a sensitive topic - your answer helps us build an accurate profile and is completely confidential and only shared with your stylist.</p>
                        <input placeholder="Type your answer here" type="text" />
                        <p class="py-2 gett-text-pque">THIS QUESTION IS REQUIRED.*</p>
                     </div>
                  </div>
                  <div class="col-md-6 gett-text-img-two order-1 order-md-2">
                     <img src="{{ url('images/stylist/16.jpg') }}" alt=""  style="width: 100%;">
                  </div>
               </div>
            </div>
         </section>
         <section>
            <div class="container-fluid ">
               <div class="row my-md-5 align-items-start">
                  <div class="col-md-4 sticky-div p-md-0 m-md-0 px-md-5 px-0" >
                     <div class="row">
                        <img src="{{ url('images/stylist/Capture.JPG') }}" alt=""  style="width: 100%;">   
                        <h1 class="py-4 dappr-altenative">Your Winter DAPPR Preview! Press play for a talk through on what I’ve chosen and why</h1>
                     </div>
                  </div>
                  <div class="col-md-8 ">
                     <div class="row">
                     <div class="col-md-6 pl-md-5  pt-0 pr-0"style="overflow: hidden;">
                           <span class="ref-btn-2"><img src="{{ url('images/stylist/12Capture.JPG') }}" alt=""  style="width: 100%;object-fit: cover;height: 100%;">  </span>
                           <div class="ref-btn">
                           <!-- <i class="fa-thin fa-arrows-rotate"></i> --><img src="{{ url('images/stylist/sync.png') }}" alt=""  style="width: 100%;">   
                              <span class="pl-2"style="color: #ffffff73;">shaan</span>
                              </i>
                           </div>
                           <div class="ref-btn-two">
                           <img src="{{ url('images/stylist/sync.png') }}" alt=""  style="width: 100%;">  
                              <span class="pl-2"style="color: #ffffff73;">shaan</span>
                              </i>
                           </div>
                        </div>
                        <div class="col-md-6 dappr-altenative-style">
                           <h1>Twill Carrot Fit Pant</h1>
                           <p>Price $99.95</p>
                           <button type="button" class="btn btn-dark">ADD TO BAG</button>
                           <p class="pt-5 dc-style-t ">DESCRIPTION</p>
                           <p class=" dc-style-to pb-3">It’s made to a relaxed fit and can be easily layered over or under. Made from warm pure soft thick cotton, this overshirt is suitable to wear as a light jacket. Designed in a textural woven check pattern that seamlessly interweaves navy, deep green and black. Note the zip through designer with 2 way zip closure - so it can be worn partially opened from the hem or neck, allowing true versatility in styling. Style with your favourite denim for a laid back California-cool look, or with tailored pants for a more urban edit.</p>
                           <input placeholder="FABRIC" type="text" />
                           <input placeholder="CARE" type="text" />
                        </div>

                        <div class="col-md-12 m-md-5 my-3 border-botom-style"></div>

                         <div class="col-md-6 pl-md-5  pt-0 pr-0"style="overflow: hidden;">
                           <span class="ref-btn-2"><img src="{{ url('images/stylist/12Capture.JPG') }}" alt="" style="width: 100%;object-fit: cover;height: 100%;">  </span>
                           <div class="ref-btn">
                              <i class="fal fa-crown menu-icon">
                              <span class="pl-2">Alternative</span>
                              </i>
                           </div>
                        </div>
                        <div class="col-md-6 dappr-altenative-style">
                           <h1>Twill Carrot Fit Pant</h1>
                           <p>Price $99.95</p>
                           <button type="button" class="btn btn-dark">ADD TO BAG</button>
                           <p class="pt-5 dc-style-t ">DESCRIPTION</p>
                           <p class=" dc-style-to pb-3">It’s made to a relaxed fit and can be easily layered over or under. Made from warm pure soft thick cotton, this overshirt is suitable to wear as a light jacket. Designed in a textural woven check pattern that seamlessly interweaves navy, deep green and black. Note the zip through designer with 2 way zip closure - so it can be worn partially opened from the hem or neck, allowing true versatility in styling. Style with your favourite denim for a laid back California-cool look, or with tailored pants for a more urban edit.</p>
                           <input placeholder="FABRIC" type="text" />
                           <input placeholder="CARE" type="text" />
                        </div>

                        <div class="col-md-12 m-md-5 my-3 border-botom-style"></div>

                        <div class="col-md-6 pl-md-5  pt-0 pr-0"style="overflow: hidden;">
                           <span class="ref-btn-2"><img src="{{ url('images/stylist/12Capture.JPG') }}" alt="" style="width: 100%;object-fit: cover;height: 100%;">  </span>
                           <div class="ref-btn">
                              <i class="fal fa-crown menu-icon">
                              <span class="pl-2">Alternative</span>
                              </i>
                           </div>
                        </div>
                        <div class="col-md-6 dappr-altenative-style">
                           <h1>Twill Carrot Fit Pant</h1>
                           <p>Price $99.95</p>
                           <button type="button" class="btn btn-dark">ADD TO BAG</button>
                           <p class="pt-5 dc-style-t ">DESCRIPTION</p>
                           <p class=" dc-style-to pb-3">It’s made to a relaxed fit and can be easily layered over or under. Made from warm pure soft thick cotton, this overshirt is suitable to wear as a light jacket. Designed in a textural woven check pattern that seamlessly interweaves navy, deep green and black. Note the zip through designer with 2 way zip closure - so it can be worn partially opened from the hem or neck, allowing true versatility in styling. Style with your favourite denim for a laid back California-cool look, or with tailored pants for a more urban edit.</p>
                           <input placeholder="FABRIC" type="text" />
                           <input placeholder="CARE" type="text" />
                        </div>

                        <div class="col-md-12 m-md-5 my-3 border-botom-style"></div>

                        <div class="col-md-6 pl-md-5  pt-0 pr-0"style="overflow: hidden;">
                           <span class="ref-btn-2"><img src="{{ url('images/stylist/12Capture.JPG') }}" alt="" style="width: 100%;object-fit: cover;height: 100%;">  </span>
                           <div class="ref-btn">
                              <i class="fal fa-crown menu-icon">
                              <span class="pl-2">Alternative</span>
                              </i>
                           </div>
                        </div>
                        <div class="col-md-6 dappr-altenative-style">
                           <h1>Twill Carrot Fit Pant</h1>
                           <p>Price $99.95</p>
                           <button type="button" class="btn btn-dark">ADD TO BAG</button>
                           <p class="pt-5 dc-style-t ">DESCRIPTION</p>
                           <p class=" dc-style-to pb-3">It’s made to a relaxed fit and can be easily layered over or under. Made from warm pure soft thick cotton, this overshirt is suitable to wear as a light jacket. Designed in a textural woven check pattern that seamlessly interweaves navy, deep green and black. Note the zip through designer with 2 way zip closure - so it can be worn partially opened from the hem or neck, allowing true versatility in styling. Style with your favourite denim for a laid back California-cool look, or with tailored pants for a more urban edit.</p>
                           <input placeholder="FABRIC" type="text" />
                           <input placeholder="CARE" type="text" />
                        </div>
                     </div>

                    <a href="" class="text-decoration-none">
                      <div class="p-3 my-3 text-center proceed-checkout-style m-auto "style="    width: 94%;">PROCEED TO CHECKOUT</div>
                    </a>


                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>   
</div>




<div class="d-flex py-2 px-5  botom-style-previous">
    <a href="#">Next</a> <div class="border-btn-footer px-3">______</div>                       
</div>


</br>



<div class="d-flex py-2 px-5 justify-content-end botom-style-previous flot-right">
    <a href="#">Next</a>                 
</div>


</br>
<div class="text-center p-3 border "   ><i class="fa fa-lock px-2" aria-hidden="true"></i>dapper.com.au</div>  
</br>







<div class="d-flex py-2 px-5 justify-content-between botom-style-previous">
    <a href="#">Previous</a>
      <span class="d-flex">
        <a href="#">04</a>
          <div class="border-btn-footer px-3">______</div>
        <a href="#">04</a>
      </span>
    <a href="#">Next</a>                    
</div>
<div class="text-center p-3 bg-dark text-light ">SAVE & CONTINUE LATER</div>  


  <link href="{{ url('css/frotend-stylist-form-common.css?').rand(10,1000) }}" rel="stylesheet">
@endsection
@section('scripts')
<script></script>
@endsection
