<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="">
                    <a href="">
                        <i class="fas fa-cog"></i> 
                        <span>Settings</span>
                    </a>
                </li>
                <li class="submenu ">
                    <a>
                        <i class="fas fa-tachometer-alt"></i>
                        <span> Dashboard</span> 
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="" class="">Admin Dashboard</a></li>
                        <li><a href="" class="">Teacher Dashboard</a></li>
                        <li><a href="" class="">Student Dashboard</a></li>
                    </ul>
                </li>
                {{-- @if (Session::get('role_name') === 'Admin' || Session::get('role_name') === 'Super Admin') --}}
                <li class="submenu ">
                    <a href="#">
                        <i class="fas fa-shield-alt"></i>
                        <span>User Management</span> 
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="" class="">List Users</a></li>
                    </ul>
                </li>
                {{-- @endif --}}

                <li class="submenu">
                    <a href="#"><i class="fas fa-graduation-cap"></i>
                        <span> Students</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{route('students.index')}}"  class="">Student List</a></li>
                        <li><a href="{{route('students.create')}}" class="">Student Add</a></li>
                        <li><a href="" class="">Student Edit</a></li>
                        <li><a href=""  class="">Student View</a></li>
                    </ul>
                </li>

                <li class="submenu ">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i>
                        <span> Teachers</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="" class="">Teacher List</a></li>
                        <li><a href="teacher-details.html">Teacher View</a></li>
                        <li><a href="" class="">Teacher Add</a></li>
                        <li><a class="">Teacher Edit</a></li>
                    </ul>
                </li>
                
                <li class="submenu">
                    <a href="#"><i class="fas fa-building"></i>
                        <span> Departments</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="" class="">Department List</a></li>
                        <li><a href="" class="">Department Add</a></li>
                        <li><a>Department Edit</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-book-reader"></i>
                        <span> Subjects</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a class="">Subject List</a></li>
                        <li><a class="">Subject Add</a></li>
                        <li><a>Subject Edit</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i>
                        <span> Invoices</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a class="" href="">Invoices List</a></li>
                        <li><a class="" href="">Invoices Grid</a></li>
                        <li><a class="" href="">Add Invoices</a></li>
                        <li><a class="" href="">Edit Invoices</a></li>
                        <li> <a class="" href="">Invoices Details</a></li>
                        <li><a class="" href="">Invoices Settings</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Management</span>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i>
                        <span> Accounts</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a class="" href="">Fees Collection</a></li>
                        <li><a href="expenses.html">Expenses</a></li>
                        <li><a href="salary.html">Salary</a></li>
                        <li><a class="" href="">Add Fees</a></li>
                        <li><a href="add-expenses.html">Add Expenses</a></li>
                        <li><a href="add-salary.html">Add Salary</a></li>
                    </ul>
                </li>
                <li>
                    <a href="holiday.html"><i class="fas fa-holly-berry"></i> <span>Holiday</span></a>
                </li>
                <li>
                    <a href="fees.html"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
                </li>
                <li>
                    <a href="exam.html"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                </li>
                <li>
                    <a href="event.html"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                </li>
                <li>
                    <a href="library.html"><i class="fas fa-book"></i> <span>Library</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>