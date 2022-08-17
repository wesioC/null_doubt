<style type="text/css">

.wrapper {
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
}

.navbar {
    height: 75px;
    transition: all 0.5s 0.1s;
}

.navbar-offcanvas {
    z-index: 1030;
}

.navbar-offcanvas .container-fluid {
    position: relative;
    padding: 0;
    transform: translate3d(10px, 0, 0);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
}

.navbar-offcanvas .navbar-top {
    display: none;
}

@media (min-width: 992px) {
    .navbar-offcanvas .navbar-top {
        display: flex;
        margin-left: auto;
    }
}

.navbar-offcanvas .navbar-top .nav-item {
    margin-right: 22px;
    text-align: center;
}

@media (max-width: 991px) {
    .navbar-offcanvas .navbar-top .nav-item .nav-link {
        color: white;
    }
}

.navbar-offcanvas .navbar-toggler {
    padding: 0;
    border: 0;
    outline: none;
}

.navbar-offcanvas .navbar-toggler:hover,
.navbar-offcanvas .navbar-toggler:focus {
    cursor: pointer;
}

@media (min-width: 768px) {
    .navbar-offcanvas .navbar-toggler {
        display: block;
    }
}

.navbar-offcanvas .navbar-toggler .icon-bar {
    display: block;
    position: relative;
    width: 24px;
    height: 2px;
    border-radius: 1px;
    background-color: white;
}

.navbar-offcanvas .navbar-toggler .icon-bar+.icon-bar {
    margin-top: 4px;
}

.navbar-offcanvas .navbar-toggler .icon-bar.bar1 {
    top: 0;
    outline: 1px solid transparent;
    animation: topbar-back 500ms 0s;
    animation-fill-mode: forwards;
}

.navbar-offcanvas .navbar-toggler .icon-bar.bar2 {
    outline: 1px solid transparent;
    opacity: 1;
}

.navbar-offcanvas .navbar-toggler .icon-bar.bar3 {
    bottom: 0;
    outline: 1px solid transparent;
    animation: bottombar-back 500ms 0s;
    animation-fill-mode: forwards;
}

.navbar-offcanvas .navbar-toggler.toggled .icon-bar.bar1 {
    top: 6px;
    animation: topbar-x 500ms 0s;
    animation-fill-mode: forwards;
}

.navbar-offcanvas .navbar-toggler.toggled .icon-bar.bar2 {
    opacity: 0;
}

.navbar-offcanvas .navbar-toggler.toggled .icon-bar.bar3 {
    bottom: 6px;
    animation: bottombar-x 500ms 0s;
    animation-fill-mode: forwards;
}

.navbar-offcanvas .navbar-collapse.collapse,
.navbar-offcanvas .navbar-collapse.collapse.in,
.navbar-offcanvas .navbar-collapse.collapsing {
    display: none !important;
}

.nav-open .navbar-collapse {
    transform: translate3d(0px, 0, 0);
}

.nav-open .navbar>.container-fluid {
    transform: translate3d(-424px, 0, 0);
}

@media (max-width: 991px) {
    .nav-open .navbar>.container-fluid {
        transform: translate3d(-282.6666666667px, 0, 0);
    }
}

.nav-open .wrapper {
    transform: translate3d(-150px, 0, 0);
}

body>.navbar-collapse {
    display: block !important;
    position: fixed;
    top: 0;
    right: -10px;
    width: 424px;
    height: 100%;
    padding: 60px 1rem;
    background-color: white;
    border-left: 1px solid #e3e3e3;
    text-align: center;
    visibility: visible;
    overflow-y: visible;
    transform: translate3d(424px, 0, 0);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    z-index: 1032;
}

body>.navbar-collapse:after {
    content: "";
    position: absolute;
    top: 28px;
    left: -20px;
    border-left: 10px solid #fff;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-right: 10px solid transparent;
    transform: rotate(180deg);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    z-index: 1032;
}

@media (max-width: 991px) {
    body>.navbar-collapse {
        width: 282.6666666667px;
    }
}

body>.navbar-collapse .nav-image {
    margin-bottom: 100px;
}

body>.navbar-collapse .nav-image img {
    display: block;
    margin: 0 auto;
    border: 1px solid rgba(0, 13, 255, 0.14);
    width: 100px;
    height: 100px;
}

body>.navbar-collapse .navbar-top {
    margin: 0 !important;
    flex-direction: column;
}

@media (min-width: 992px) {
    body>.navbar-collapse .navbar-top {
        display: none;
    }
}

body>.navbar-collapse .navbar-top li {
    text-align: center;
}

body>.navbar-collapse .navbar-top li a {
    display: block;
    padding: 0.5rem 1rem;
    font-weight: 700;
    color: #000;
}

body>.navbar-collapse .navbar-top li a:hover,
body>.navbar-collapse .navbar-top li a:focus {
    text-decoration: none;
}

body>.navbar-collapse .nav-link,
body>.navbar-collapse .dropdown-toggle {
    font-weight: 700;
    color: white;
    transition: color 0.2s ease-out;
}

body>.navbar-collapse .nav-link:hover,
body>.navbar-collapse .nav-link:focus,
body>.navbar-collapse .dropdown-toggle:hover,
body>.navbar-collapse .dropdown-toggle:focus {
    text-decoration: none;
}

body>.navbar-collapse .nav-link.disabled,
body>.navbar-collapse .dropdown-toggle.disabled {
    color: rgba(0, 0, 0, 0.35);
}

body>.navbar-collapse .nav-link.disabled:hover,
body>.navbar-collapse .nav-link.disabled:focus,
body>.navbar-collapse .dropdown-toggle.disabled:hover,
body>.navbar-collapse .dropdown-toggle.disabled:focus {
    cursor: not-allowed;
}

@media (min-width: 992px) {
    body>.navbar-top {
        display: none;
    }
}

body>#overlay {
    content: "";
    position: fixed;
    top: 0;
    left: auto;
    right: calc(282.6666666667px - 10px);
    width: 100%;
    height: 100%;
    opacity: 0;
    overflow-x: hidden;
    z-index: 1029;
}

@media (min-width: 992px) {
    body>#overlay {
        right: calc(424px - 10px);
    }
}

@keyframes topbar-x {
    0% {
        top: 0px;
        transform: rotate(0deg);
    }
    45% {
        top: 6px;
        transform: rotate(145deg);
    }
    75% {
        transform: rotate(130deg);
    }
    100% {
        transform: rotate(135deg);
    }
}

@keyframes topbar-back {
    0% {
        top: 6px;
        transform: rotate(135deg);
    }
    45% {
        transform: rotate(-10deg);
    }
    75% {
        transform: rotate(5deg);
    }
    100% {
        top: 0px;
        transform: rotate(0);
    }
}

@keyframes bottombar-x {
    0% {
        bottom: 0px;
        transform: rotate(0deg);
    }
    45% {
        bottom: 6px;
        transform: rotate(-145deg);
    }
    75% {
        transform: rotate(-130deg);
    }
    100% {
        transform: rotate(-135deg);
    }
}

@keyframes bottombar-back {
    0% {
        bottom: 6px;
        transform: rotate(-135deg);
    }
    45% {
        transform: rotate(10deg);
    }
    75% {
        transform: rotate(-5deg);
    }
    100% {
        bottom: 0px;
        transform: rotate(0);
    }
}

.img-200-200 {
    width: 200px;
}

</style>
