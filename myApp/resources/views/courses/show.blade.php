 @php
     use App\Models\Course;
     use App\Models\Playlist;
     $course = Course::with('playlists')->find($course->id);
 @endphp
 <x-page-layout>
     <div class="py-12">
         <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 {{-- header --}}
                 <div class="p-10 text-gray-900 space-y-8">

                     {{-- ? image and couse title and description section --}}
                     <div class="h-full w-full flex items-center justify-between  space-x-2">

                         <div class=" w-full  space-y-5">
                             <h2 class="course-name text-3xl  tracking-wide text-gray-800 mb-4">
                                 {{ $course->name }}
                             </h2>
                             <p class="course-description text-gray-600  leading-relaxed">
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

                         <div class="  shadow-lg w-full h-[300px] rounded-md">

                             <img src="{{ asset('upload/courses') }}/{{ $course->image }}"
                                 class="w-full h-full object-cover rounded-md" alt="">
                         </div>

                     </div>

                     {{-- ? coure detail section --}}
                     <div class="border-t-2 border-gray-400/50  w-full"></div>

                     <div class="w-full flex justify-evenly items-baseline  ">
                         <div class=" w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                             <span class="text-lg">Category</span>
                             <span class="rounded-md w-fit p-2 text-xs text-gray-800 bg-blue-500/30">
                                 #{{ $course->category }} </span>
                         </div>

                         <div class=" w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                             <span class="text-lg"> Purshace for</span>
                             <span class="text-gray-700 ">$ {{ $course->price }}</span>
                         </div>

                         <div class=" w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                             <span class="text-lg">Istemeted Time </span>
                             <span class="text-gray-700 ">{{ $course->duration }} weeks</span>
                         </div>
                         <div class="w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                             <span class="text-lg">Level</span>
                             <span class="text-gray-700 ">{{ $course->level }}</span>
                         </div>

                     </div>

                     <div class="border-t-2 border-gray-400/50  w-full"></div>

                     <div class=" space-y-8">
                         <h2 class="text-xl  text-black ">Course content</h2>
                         <div class=" w-full space-y-3">

                             @foreach ($course->playlists as $playlist)
                                 @php
                                     $playlist = Playlist::with('videos')->find($playlist->id);
                                 @endphp
                                 <div class=" space-y-2">
                                     {{-- ? Playlist section --}}
                                     <div class="col-span-2 p-4 space-y-3">
                                         <div
                                             class="playlist group w-full flex justify-between items-center bg-white rounded-md ">
                                             <h2 class="text-lg border-l-4 border-blue-600 px-2  text-gray-900">
                                                 {{ $playlist->name }}
                                             </h2>
                                             <i class="fa-solid fa-angle-right group-hover:rotate-90"></i>
                                         </div>

                                         <ul class="list-items hidden  mx-[-1px] space-y-0 ">
                                             @foreach ($playlist->videos as $video)
                                                 <x-courseComponents.playlist-item
                                                     href="{{ route('coach.playlists.show', ['playlist' => $playlist, 'video' => $video]) }}"
                                                     :videoTitle="$video->title" :video="$video" />
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
 </x-page-layout>

 <x-formComponents.popup-form id="go-to-payment-popup">
     <x-slot:closeBtn>
         <button class="enroll-close-btn hover:scale-125 transition-all ease-in">
             <i class="fa-solid fa-xmark"></i>
         </button>
     </x-slot:closeBtn>


     <form action="{{ route('user.payment.payment') }}" method="POST"
         class="space-y-5 min-w-screen-md grid grid-cols-2 gap-x-2">
         @csrf
         <input type="hidden" name="amount" value="{{ $course->price }}">
         <x-formComponents.form-button type='submit'>Pay with Paypal</x-formComponents.form-button>
     </form>

 </x-formComponents.popup-form>


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
