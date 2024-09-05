 @php
     use App\Models\Course;
     use App\Models\Playlist;
     $course = Course::with('playlists')->find($course->id);
 @endphp
 <x-page-layout>
     <div class="sm:py-5 max-w-8xl mx-auto sm:px-6 lg:px-8">
         <div class="backdrop-blur-3xl bg-black/50  overflow-hidden shadow-sm sm:rounded-lg">
             {{-- header --}}
             <div class="p-5 sm:p-10 space-y-6">

                 {{-- ? image and couse title and description section --}}
                 <div class="h-full w-full grid gap-y-4 md:grid-cols-2 md:gap-2 ">

                     <div class=" w-full space-y-5 overflow-y-scroll">
                         <h2
                             class="course-name text-3xl sm:text-4xl  lg:text-5xl tracking-wide text-white font-semibold mb-4">
                             {{ $course->name }}
                         </h2>
                         <p class="course-description text-gray-400   leading-relaxed">
                             {{ $course->description }}
                         </p>

                         <div class=" space-y-4">
                             @if (request()->routeIs('coach.*'))
                                 <x-courseComponents.course-link
                                     href="{{ route('coach.courses.watch', ['course' => $course]) }}">
                                     View Course
                                 </x-courseComponents.course-link>
                             @endif

                             @if (request()->routeIs('user.*') && Auth::user()->isEnrolledIn($course))
                                 <x-courseComponents.course-link
                                     href="{{ route('user.courses.watch', ['course' => $course]) }}">
                                     Go to course
                                 </x-courseComponents.course-link>
                             @endif

                             @if (request()->routeIs('user.*') && !Auth::user()->isEnrolledIn($course))
                                 <x-courseComponents.course-enrollbutton class="enroll-open-btn" type='submit'>
                                     Enroll Now
                                 </x-courseComponents.course-enrollbutton>
                             @endif

                         </div>
                     </div>

                     <div class="  shadow-lg w-full max-h-[350px] rounded-md">
                         <img src="{{ asset('upload/courses') }}/{{ $course->image }}"
                             class="w-full h-full object-cover rounded-md" alt="">
                     </div>

                 </div>

                 {{-- ? coure detail section --}}
                 <div class="border-t-2 border-gray-400/10  w-full"></div>

                 <div class="w-full flex flex-wrap  justify-evenly items-baseline  ">
                     <div class=" w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                         <span class="text-sm md:text-md lg:text-lg text-gray-200 font-semibold">Category</span>
                         <span class="text-sm md:text-md  rounded-md w-fit  font-semibold text-gray-400 ">
                             #{{ $course->category }} </span>
                     </div>

                     <div class=" w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                         <span class="text-sm md:text-md lg:text-lg text-gray-200 font-semibold"> Purshace for</span>
                         <span class="text-sm md:text-md  text-gray-400 font-semibold">$
                             {{ $course->price }}</span>
                     </div>

                     <div class=" w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                         <span class="text-sm md:text-md lg:text-lg text-gray-200 font-semibold">Istemeted Time </span>
                         <span class="text-sm md:text-md  text-gray-400 font-semibold">{{ $course->duration }}
                             weeks</span>
                     </div>
                     <div class="w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                         <span class="text-sm md:text-md lg:text-lg text-gray-200 font-semibold">Level</span>
                         <span class="text-sm md:text-md  text-gray-400 font-semibold">{{ $course->level }}</span>
                     </div>

                 </div>

                 <div class="border-t-2 border-gray-400/10   w-full"></div>

                 <div class=" space-y-8">
                     <h2 class="text-xl  lg:text-2xl  border-l-4 border-orange-600 px-2 text-white font-semibold ">
                         Course content
                     </h2>
                     <div class=" w-full space-y-3">

                         @foreach ($course->playlists as $playlist)
                             @php
                                 $playlist = Playlist::with('videos')->find($playlist->id);
                             @endphp
                             <div class="">
                                 {{-- ? Playlist section --}}
                                 <div class="space-y-3">
                                     <div class="playlist group w-full flex justify-between items-center  rounded-md ">
                                         <h2 class="font-semibold text-md  lg:text-lg  px-2  text-gray-300">
                                             {{ $playlist->name }}
                                         </h2>
                                         <i class="fa-solid fa-angle-right text-orange-600 group-hover:rotate-90"></i>
                                     </div>

                                     <ul class="list-items hidden md:px-8 ">
                                         @foreach ($playlist->videos as $video)
                                             <x-courseComponents.playlist-item :videoTitle="$video->title" :video="$video" />
                                         @endforeach

                                     </ul>
                                 </div>
                                 {{-- ? --}}
                             </div>
                         @endforeach
                     </div>
                 </div>

             </div>
         </div>
     </div>
     {{-- notifications --}}
     @session('success')
         <x-notificationCards.notif-success>{{ session('success') }}</x-notificationCards.notif-success>
     @endsession
     @session('error')
         <x-notificationCards.notif-error>{{ session('error') }}</x-notificationCards.notif-error>
     @endsession
 </x-page-layout>

 <x-formComponents.popup-form id="go-to-payment-popup">
     <x-slot:closeBtn>
         <button class="enroll-close-btn hover:scale-125 transition-all ease-in">
             <i class="fa-solid fa-xmark"></i>
         </button>
     </x-slot:closeBtn>


     <form action="{{ route('user.payment.payment') }}" method="POST" class="w-full space-y-5 min-w-screen-md ">
         @csrf
         <input type="hidden" name="amount" value="{{ $course->price }}">
         <input type="hidden" name="course_id" value="{{ $course->id }}">
         <!-- PayPal Logo -->


         <div class="w-full flex justify-center items-center">
             <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg" border="0"
                 alt="PayPal Logo" class="">
         </div>

         <!-- PayPal Logo -->
         <x-formComponents.form-button type='submit'>Pay with Paypal</x-formComponents.form-button>
     </form>

 </x-formComponents.popup-form>


 <script src="{{ asset('js/notif.js') }}"></script>
 <script>
     /**
      * Go to payment popup page 
      */
     const goToPaymentPopup = document.getElementById('go-to-payment-popup');
     document.querySelector('.enroll-open-btn').addEventListener('click', showGoToPaymentPopup);
     document.querySelector('.enroll-close-btn').addEventListener('click', hideGoToPaymentPopup);;

     function showGoToPaymentPopup() {
         document.body.overflow = "hidden";
         goToPaymentPopup.classList.remove('hidden');
     }

     function hideGoToPaymentPopup() {
         document.body.overflow = "visible";
         goToPaymentPopup.classList.add('hidden');
     }
 </script>
