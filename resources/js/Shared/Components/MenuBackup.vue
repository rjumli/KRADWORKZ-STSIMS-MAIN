<template>
    <BContainer fluid>
        <div id="two-column-menu"></div>

        <template v-if="layoutType === 'vertical' || layoutType === 'semibox'">
            <ul class="navbar-nav h-100" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu"> {{ $t("krad-menu") }}</span>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" href="/" :class="{'active': $page.component.startsWith('Modules/Home') }">
                        <i class="ri ri-apps-line"></i>
                        <span data-key="krad-dashboards"> {{ $t("krad-dashboards") }}</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" href="#scholars" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-team-fill"></i>
                        <span data-key="krad-scholars">{{$t("krad-scholars")}}</span>
                    </Link>
                    <div class="collapse menu-dropdown" id="scholars">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <Link class="nav-link" href="/schools">{{ $t("krad-lists") }}</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" href="/courses">{{ $t("krad-qualifiers") }}</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" href="/certifications">{{ $t("krad-endorsement") }}</Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                  <Link class="nav-link menu-link" href="/staffs">
                      <i class="bx bx-user-circle"></i>
                      <span data-key="krad-staffs"> {{ $t("krad-staffs") }}</span>
                  </Link>
                </li>

                <li class="menu-title">
                    <i class="ri-more-fill"></i>
                    <span data-key="krad-lists">{{ $t("krad-lists") }}</span>
                </li>

                <li class="nav-item">
                    <Link class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-book-mark-fill"></i>
                        <span data-key="krad-directory">{{$t("krad-directory")}}</span>
                    </Link>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <Link class="nav-link" href="/schools">{{ $t("krad-schools") }}</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" href="/courses">{{ $t("krad-course") }}</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" href="/certifications">{{ $t("krad-certifications") }}</Link>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Lists/Dropdowns') }" href="/lists/dropdowns">
                        <i class="ri-list-check"></i>
                        <span data-key="krad-dropdown">{{$t("krad-dropdown")}}</span>
                    </Link>
                </li>

                <li class="nav-item">
                    <Link class="nav-link menu-link" href="#location" :class="{'active': $page.component.startsWith('Modules/Lists/Locations') }"
                    data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="location">
                        <i class="ri-earth-fill"></i>
                        <span data-key="krad-location">{{$t("krad-location")}}</span>
                    </Link>
                    <div class="collapse menu-dropdown" id="location">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <Link class="nav-link" :class="{'active': $page.url === '/lists/locations/regions' }" href="/lists/locations/regions">{{ $t("krad-region") }}</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" :class="{'active': $page.url === '/lists/locations/provinces' }" href="/lists/locations/provinces">{{ $t("krad-province") }}</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" :class="{'active': $page.url === '/lists/locations/municipalities' }" href="/lists/locations/municipalities">{{ $t("krad-municipality") }}</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" :class="{'active': $page.url === '/lists/locations/barangays' }" href="/lists/locations/barangays">{{ $t("krad-barangay") }}</Link>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- <li class="menu-title">
                    <i class="ri-more-fill"></i>
                    <span data-key="krad-configuration">{{ $t("krad-configuration") }}</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#utility" :class="{'active': $page.component.startsWith('Modules/Utility') }"
                        data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                        <i class="ri-settings-4-fill"></i>
                        <span data-key="krad-utility">{{ $t("krad-utility") }}</span>
                    </a>
                    <div class="collapse menu-dropdown" id="utility">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                              <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility/Users') }" href="/utility/users">{{ $t("krad-users") }}</Link>
                            </li>
                           <li class="nav-item">
                              <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility/Config') }" href="/utility/config">{{ $t("krad-config") }}</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility/Backups') }" href="/utility/backups">{{ $t("krad-backup") }}</Link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#logs" :class="{'active': $page.component.startsWith('Modules/Utility/Logs') }"
                                data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAccount" data-key="t-level-1.2">
                                {{ $t("krad-logs") }}
                                </a>
                                <div class="collapse menu-dropdown" id="logs">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility/Logs/Activities') }" href="/utility/logs/activities">{{ $t("krad-activity") }}</Link>
                                        </li>
                                        <li class="nav-item">
                                          <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility/Logs/Authentications') }" href="/utility/logs/authentications">{{ $t("krad-authentication") }}</Link>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li> -->
            </ul>
        </template>
    </BContainer>
</template>
<script>
import { layoutComputed } from "@/Shared/State/helpers";
import simplebar from "simplebar-vue";

export default {
  components: {
    simplebar,
  },
  data() {
    return {
      settings: {
        minScrollbarLength: 60,
      },
    };
  },
  computed: {
    ...layoutComputed,
    layoutType: {
      get() {
        return this.$store ? this.$store.state.layout.layoutType : {} || {};
      },
    },
  },
  mounted() {
    this.initActiveMenu();
    this.onRoutechange();
    if (document.querySelectorAll(".navbar-nav .collapse")) {
      let collapses = document.querySelectorAll(".navbar-nav .collapse");

      collapses.forEach((collapse) => {
        // Hide sibling collapses on `show.bs.collapse`
        collapse.addEventListener("show.bs.collapse", (e) => {
          e.stopPropagation();
          let closestCollapse = collapse.parentElement.closest(".collapse");
          if (closestCollapse) {
            let siblingCollapses =
              closestCollapse.querySelectorAll(".collapse");
            siblingCollapses.forEach((siblingCollapse) => {
              if (siblingCollapse.classList.contains("show")) {
                siblingCollapse.classList.remove("show");
                siblingCollapse.parentElement.firstChild.setAttribute("aria-expanded", "false");
              }
            });
          } else {
            let getSiblings = (elem) => {
              // Setup siblings array and get the first sibling
              let siblings = [];
              let sibling = elem.parentNode.firstChild;
              // Loop through each sibling and push to the array
              while (sibling) {
                if (sibling.nodeType === 1 && sibling !== elem) {
                  siblings.push(sibling);
                }
                sibling = sibling.nextSibling;
              }
              return siblings;
            };
            let siblings = getSiblings(collapse.parentElement);
            siblings.forEach((item) => {
              if (item.childNodes.length > 2) {
                item.firstElementChild.setAttribute("aria-expanded", "false");
                item.firstElementChild.classList.remove("active");
              }
              let ids = item.querySelectorAll("*[id]");
              ids.forEach((item1) => {
                item1.classList.remove("show");
                item1.parentElement.firstChild.setAttribute("aria-expanded", "false");
                item1.parentElement.firstChild.classList.remove("active");
                if (item1.childNodes.length > 2) {
                  let val = item1.querySelectorAll("ul li a");

                  val.forEach((subitem) => {
                    if (subitem.hasAttribute("aria-expanded"))
                      subitem.setAttribute("aria-expanded", "false");
                  });
                }
              });
            });
          }
        });

        // Hide nested collapses on `hide.bs.collapse`
        collapse.addEventListener("hide.bs.collapse", (e) => {
          e.stopPropagation();
          let childCollapses = collapse.querySelectorAll(".collapse");
          childCollapses.forEach((childCollapse) => {
            let childCollapseInstance = childCollapse;
            childCollapseInstance.classList.remove("show");
            childCollapseInstance.parentElement.firstChild.setAttribute("aria-expanded", "false");
          });
        });
      });
    }
  },

  methods: {
    onRoutechange() {
      // this.initActiveMenu();
      setTimeout(() => {
        var currentPath = window.location.pathname;
        if (document.querySelector("#navbar-nav")) {
          let currentPosition = document.querySelector("#navbar-nav").querySelector('[href="' + currentPath + '"]')?.offsetTop;
          if (currentPosition > document.documentElement.clientHeight) {
            document.querySelector("#scrollbar .simplebar-content-wrapper") ? document.querySelector("#scrollbar .simplebar-content-wrapper").scrollTop = currentPosition + 300 : '';
          }
        }
      }, 500);
    },

    initActiveMenu() {
      setTimeout(() => {
        var currentPath = window.location.pathname;
        if (document.querySelector("#navbar-nav")) {
          let a = document.querySelector("#navbar-nav").querySelector('[href="' + currentPath + '"]');
          if (a) {
            a.classList.add("active");
            let parentCollapseDiv = a.closest(".collapse.menu-dropdown");
            if (parentCollapseDiv) {
              parentCollapseDiv.classList.add("show");
              parentCollapseDiv.parentElement.children[0].classList.add("active");
              parentCollapseDiv.parentElement.children[0].setAttribute("aria-expanded", "true");
              if (parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown")) {
                parentCollapseDiv.parentElement.closest(".collapse").classList.add("show");
                if (parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling)
                  parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling.classList.add("active");
                const grandparent = parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling.parentElement.closest(".collapse");
                if (grandparent && grandparent && grandparent.previousElementSibling) {
                  grandparent.previousElementSibling.classList.add("active");
                  grandparent.classList.add("show");
                }
              }
            }
          }
        }
      }, 0);
    },
  },
};
</script>