    <header class="fixed top-0 left-0 z-40 bg-gray-200 border-b border-gray-200 dark:border-gray-600 dark:bg-gray-700 w-full">
        <div class="container mx-auto">
            <!-- Add your header content here -->
            <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-0 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
             </button>
        </div>
    </header>

        <aside class="fixed top-0 left-0 z-40 w-60 h-screen pt-20 transition-transform -translate-x-full bg-gray-50 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 select-none" aria-label="Sidebar">
          <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
              <ul class="space-y-2 font-medium">
                 <li>
                    <a href="{{ route('home') }}" class="a-aside @if (str_contains(request()->path(), 'welcome')) active  @endif">
                       <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                       <span class="ml-3">Home</span>
                    </a>
                 </li>
                 <li>
                    <a href="{{ route('track') }}" class="a-aside @if (request()->route()->getName() === 'track') active @endif">
                       <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                       <span class="flex-1 ml-3 whitespace-nowrap">Shooting Tracks</span>
                       <span class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                    </a>
                 </li>

                 <li>
                    <a href="{{ route('contact') }}" class="a-aside @if (str_contains(request()->path(), 'contact')) active  @endif">
                      <svg aria-hidden="true" class=" w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 122.88 122.27" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path d="M33.84,50.25c4.13,7.45,8.89,14.6,15.07,21.12c6.2,6.56,13.91,12.53,23.89,17.63c0.74,0.36,1.44,0.36,2.07,0.11 c0.95-0.36,1.92-1.15,2.87-2.1c0.74-0.74,1.66-1.92,2.62-3.21c3.84-5.05,8.59-11.32,15.3-8.18c0.15,0.07,0.26,0.15,0.41,0.21 l22.38,12.87c0.07,0.04,0.15,0.11,0.21,0.15c2.95,2.03,4.17,5.16,4.2,8.71c0,3.61-1.33,7.67-3.28,11.1 c-2.58,4.53-6.38,7.53-10.76,9.51c-4.17,1.92-8.81,2.95-13.27,3.61c-7,1.03-13.56,0.37-20.27-1.69 c-6.56-2.03-13.17-5.38-20.39-9.84l-0.53-0.34c-3.31-2.07-6.89-4.28-10.4-6.89C31.12,93.32,18.03,79.31,9.5,63.89 C2.35,50.95-1.55,36.98,0.58,23.67c1.18-7.3,4.31-13.94,9.77-18.32c4.76-3.84,11.17-5.94,19.47-5.2c0.95,0.07,1.8,0.62,2.25,1.44 l14.35,24.26c2.1,2.72,2.36,5.42,1.21,8.12c-0.95,2.21-2.87,4.25-5.49,6.15c-0.77,0.66-1.69,1.33-2.66,2.03 c-3.21,2.33-6.86,5.02-5.61,8.18L33.84,50.25L33.84,50.25L33.84,50.25z"/>
                        </g>
                     </svg>

                       <span class="flex-1 ml-3 whitespace-nowrap">Contact</span>
                    </a>
                 </li>
                 @if(auth()->check())
                 <li>
                    <a href="{{ route('calendar') }}" class="a-aside @if (str_contains(request()->path(), 'calendar')) active  @endif">
                       {{-- <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg> --}}
                       <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor"  viewBox="0 0 1664 1792" xmlns="http://www.w3.org/2000/svg"><path d="M128 1664h288v-288H128v288zm352 0h320v-288H480v288zm-352-352h288V992H128v320zm352 0h320V992H480v320zM128 928h288V640H128v288zm736 736h320v-288H864v288zM480 928h320V640H480v288zm768 736h288v-288h-288v288zm-384-352h320V992H864v320zM512 448V160q0-13-9.5-22.5T480 128h-64q-13 0-22.5 9.5T384 160v288q0 13 9.5 22.5T416 480h64q13 0 22.5-9.5T512 448zm736 864h288V992h-288v320zM864 928h320V640H864v288zm384 0h288V640h-288v288zm32-480V160q0-13-9.5-22.5T1248 128h-64q-13 0-22.5 9.5T1152 160v288q0 13 9.5 22.5t22.5 9.5h64q13 0 22.5-9.5t9.5-22.5zm384-64v1280q0 52-38 90t-90 38H128q-52 0-90-38t-38-90V384q0-52 38-90t90-38h128v-96q0-66 47-113T416 0h64q66 0 113 47t47 113v96h384v-96q0-66 47-113t113-47h64q66 0 113 47t47 113v96h128q52 0 90 38t38 90z"/></svg>
                       <span class="flex-1 ml-3 whitespace-nowrap">Calendar</span>
                       <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                    </a>
                 </li>

                    @if (auth()->user()->role_id == 1)
                        <li>
                            <a href="{{ route('crud') }}" class="a-aside @if (str_contains(request()->path(), 'crud') || str_contains(request()->path(), 'users') || str_contains(request()->path(), 'tracks')) active @endif">
                            <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">Club Management</span>
                            {{-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span> --}}
                            </a>
                        </li>
                    @endif

                 <li>
                  <a href="{{ route('user') }}" class="a-aside @if (request()->route()->getName() === 'user') active @endif">
                     <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                     <span class="flex-1 ml-3 whitespace-nowrap">Profile</span>
                  </a>
                 </li>
                <form action="{{ route('logout') }}" method="GET" >
                 <li>
                  <button type="submit" class="btn-aside">
                       <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path></svg>
                       <span class="ml-3 whitespace-nowrap">Log Out</span>
                  </button>
                 </li>
                </form>

                 @else
                 <li>
                    <a href="{{ route('login') }}" class="a-aside @if (str_contains(request()->path(), 'login')) active  @endif">
                       <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z" clip-rule="evenodd"></path></svg>
                       <span class="flex-1 ml-3 whitespace-nowrap">Sign In</span>
                    </a>
                 </li>
                 <li>
                    <a href="{{ route('register.create') }}" class="a-aside @if (str_contains(request()->path(), 'register')) active  @endif">
                       <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z" clip-rule="evenodd"></path></svg>
                       <span class="flex-1 ml-3 whitespace-nowrap">Register</span>
                    </a>
                 </li>
                 @endif

                 <li>
                  <button class="moon cursor-pointer bg-transparent p-2 rounded btn-log" aria-label="Switch to dark mode">
                      <svg  class="h-8 w-8 " viewBox="0 0 700 700" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
                          <g transform="matrix(1,0,0,1,-0.011379,69.9954)">
                              <g>
                                  <path d="M126,267.9C125.988,321.017 143.891,372.58 176.809,414.27C209.727,455.958 255.743,485.321 307.409,497.625C359.081,509.926 413.389,504.445 461.559,482.07C509.731,459.691 548.95,421.726 572.879,374.3C574.961,370.191 574.16,365.206 570.895,361.956C567.633,358.702 562.645,357.921 558.543,360.019C528.613,375.136 495.531,382.964 462,382.867C412.898,382.878 365.273,366.066 327.06,335.23C288.845,304.394 262.349,261.398 251.982,213.4C241.615,165.402 248.005,115.306 270.087,71.45C272.18,67.348 271.399,62.36 268.149,59.098C264.899,55.832 259.915,55.031 255.805,57.113C216.711,76.707 183.856,106.812 160.926,144.047C137.996,181.277 125.899,224.168 125.996,267.897L126,267.9Z" style="fill-rule:nonzero;"/>
                              </g>
                          </g>
                      </svg>
                    </button>
                    <button class="sun cursor-pointer bg-transparent p-2 btn-log" aria-label="Switch to light mode">
                      <svg class="h-8 w-8 dark:fill-slate-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 700 700">
                          <g transform="matrix(1,0,0,1,0,70)">
                            <path
                              d="M350,175C292.102,175 245,222.102 245,280C245,337.898 292.102,385 350,385C407.898,385 455,337.898 455,280C455,222.102 407.898,175 350,175Z"
                              style="fill-rule: nonzero"
                            />
                            <path
                              d="M350,140C359.66,140 367.5,132.16 367.5,122.5L367.5,70C367.5,60.34 359.66,52.5 350,52.5C340.34,52.5 332.5,60.34 332.5,70L332.5,122.5C332.5,132.16 340.34,140 350,140Z"
                              style="fill-rule: nonzero"
                            />
                            <path
                              d="M350,420C340.34,420 332.5,427.84 332.5,437.5L332.5,490C332.5,499.66 340.34,507.5 350,507.5C359.66,507.5 367.5,499.66 367.5,490L367.5,437.5C367.5,427.84 359.66,420 350,420Z"
                              style="fill-rule: nonzero"
                            />
                            <path
                              d="M560,262.5L507.5,262.5C497.84,262.5 490,270.34 490,280C490,289.66 497.84,297.5 507.5,297.5L560,297.5C569.66,297.5 577.5,289.66 577.5,280C577.5,270.34 569.66,262.5 560,262.5Z"
                              style="fill-rule: nonzero"
                            />
                            <path
                              d="M210,280C210,270.34 202.16,262.5 192.5,262.5L140,262.5C130.34,262.5 122.5,270.34 122.5,280C122.5,289.66 130.34,297.5 140,297.5L192.5,297.5C202.16,297.5 210,289.66 210,280Z"
                              style="fill-rule: nonzero"
                            />
                            <path
                              d="M461.37,186.13C465.851,186.13 470.323,184.423 473.741,181.001L510.866,143.876C517.698,137.044 517.698,125.966 510.866,119.13C504.034,112.298 492.956,112.298 486.12,119.13L448.995,156.255C442.163,163.087 442.163,174.165 448.995,181.001C452.409,184.423 456.89,186.13 461.37,186.13Z"
                              style="fill-rule: nonzero"
                            />
                            <path
                              d="M226.26,378.99L189.135,416.115C182.303,422.947 182.303,434.025 189.135,440.861C192.557,444.283 197.026,445.99 201.506,445.99C205.987,445.99 210.467,444.283 213.877,440.861L251.002,403.736C257.834,396.904 257.834,385.826 251.002,378.99C244.17,372.158 233.084,372.158 226.26,378.99Z"
                              style="fill-rule: nonzero"
                            />
                            <path
                              d="M473.74,378.99C466.908,372.158 455.83,372.158 448.994,378.99C442.162,385.822 442.162,396.9 448.994,403.736L486.119,440.861C489.541,444.283 494.01,445.99 498.49,445.99C502.971,445.99 507.443,444.283 510.861,440.861C517.693,434.029 517.693,422.951 510.861,416.115L473.74,378.99Z"
                              style="fill-rule: nonzero"
                            />
                            <path
                              d="M226.26,181C229.674,184.422 234.151,186.129 238.631,186.129C243.112,186.129 247.592,184.422 251.002,181C257.834,174.168 257.834,163.09 251.002,156.254L213.877,119.129C207.053,112.297 195.955,112.297 189.131,119.129C182.299,125.961 182.299,137.039 189.131,143.875L226.26,181Z"
                              style="fill-rule: nonzero"
                            />
                          </g>
                        </svg>
                    </button>
                 </li>
              </ul>
           </div>
        </aside>


