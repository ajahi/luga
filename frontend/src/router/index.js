import Vue from 'vue'
import Router from 'vue-router'
import { store } from '../store';
import Profile from '../components/dashboard/Profile';
import User from '../components/dashboard/User';
import Signup from '../components/site/Signup';
import Signin from '../components/site/Signin'
import Dashboard from '../components/dashboard/Dashboard';
import NotFound from '../components/site/NotFound';
import AccessDenied from '../components/site/Deny';
import Club from '../components/dashboard/club/Club'
import ClubList from '../components/dashboard/club/ClubList'
import Member from '../components/dashboard/member/Member'
import MemberList from '../components/dashboard/member/MemberList'
import MemberCrud from '../components/dashboard/member/MemberCrud'
import ClubCrud from '../components/dashboard/club/ClubCrud'
import YearCrud from '../components/dashboard/club/YearCrud'
import YearList from '../components/dashboard/club/YearList'
import ClubDesignationCrud from '../components/dashboard/member/ClubDesignationCrud'
import QuoteList from '../components/dashboard/quote/QuoteList'
import Quote from '../components/dashboard/quote/Quote'
import EbookList from '../components/dashboard/ebook/EbookList'
import Ebook from '../components/dashboard/ebook/Ebook'
import CalendarList from '../components/dashboard/calendar/CalendarList'
import Calendar from '../components/dashboard/calendar/Calendar'
import CategoryList from '../components/dashboard/category/CategoryList'
import Category from '../components/dashboard/category/Category'
import Post from '../components/dashboard/post/Post'
import PostList from '../components/dashboard/post/PostList'
import Tag from '../components/dashboard/tag/Tag'
import TagList from '../components/dashboard/tag/TagList'

import Home from '../components/site/Home'

const routerOptions = [
    { path: '*',
        redirect: {
            path:'/'
        }
    },
    {
        path:'/404',
        name:'NotFound',
        component: NotFound
    },
    {
        path:'/403',
        name:'AccessDenied',
        component: AccessDenied
    },
    {   path: '',
        name:'home',
        component: Home
    },
    {   path: '/login',name:'login',component: Signin },
    {   path: '/signup', component: Signup },


    //dashboard area
    {   path: '/dashboard',name:'dashboard', component: Dashboard, meta: { requiresAuth: true } },
    {   path: '/dashboard/profile',
        component: User,
        meta: {requiresAuth: true},
        props: true,
        children: [
            {path: '',component: Profile,meta:{requiresAuth:true}},

        ],
     },
    { path:'/dashboard/club/:id',component: Club,meta:{requiresAuth:true}, props:true,
      children: [
          {
              path: '', name:'club', meta:{requiresAuth:true},props:true,
              component:ClubCrud
          },
          {
              path: 'year/:yearid', name:'year', meta:{requiresAuth:true},props:true,
              component:YearCrud
          },
          {
              path: 'years', name:'yearList', meta:{requiresAuth:true},props:true,
              component:YearList
          }
      ]
    },
    { path:'/dashboard/clubs',name:'clubs',component: ClubList,meta:{requiresAuth:true} },
    { path:'/dashboard/member/:id',component: Member,meta:{requiresAuth:true}, props:true,
        children: [
            {
                path: '', name:'member', meta:{requiresAuth:true},props:true,
                component:MemberCrud
            },

        ]
    },
    {
        path: '/dashboard/member/:id/designation', name:'club-designation', meta:{requiresAuth:true},props:true,
        component:ClubDesignationCrud
    },
    { path:'/dashboard/members',name:'members',component: MemberList,meta:{requiresAuth:true} },
    { path:'/dashboard/quote/:id',name:'quote',component: Quote,meta:{requiresAuth:true} ,props:true },
    { path:'/dashboard/quotes',name:'quotes',component: QuoteList,meta:{requiresAuth:true} },
    { path:'/dashboard/ebook/:id',name:'ebook',component: Ebook,meta:{requiresAuth:true} ,props:true },
    { path:'/dashboard/ebooks',name:'ebooks',component: EbookList,meta:{requiresAuth:true} },
    { path:'/dashboard/calendar/:id',name:'calendar',component: Calendar,meta:{requiresAuth:true} ,props:true },
    { path:'/dashboard/calendars',name:'calendars',component: CalendarList,meta:{requiresAuth:true} },

    { path:'/dashboard/category/:id',name:'category',component: Category,meta:{requiresAuth:true} ,props:true },
    { path:'/dashboard/categories',name:'categories',component: CategoryList,meta:{requiresAuth:true} },

    { path:'/dashboard/post/:id',name:'post',component: Post,meta:{requiresAuth:true} ,props:true },
    { path:'/dashboard/posts',name:'posts',component: PostList,meta:{requiresAuth:true} },

    { path:'/dashboard/tag/:id',name:'tag',component: Tag,meta:{requiresAuth:true} ,props:true },
    { path:'/dashboard/tags',name:'tags',component: TagList,meta:{requiresAuth:true} },
]


/*const routes = routerOptions.map(route => {
    return {
        ...route,
        component: () => import(`@/components/${route.component}.vue`)
    }
})*/

Vue.use(Router)


const  router = new Router({
    mode: 'history',
    routes: routerOptions
})

router.beforeEach((to,from,next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth)
    const isAuthenticated = store.state.auth.token;
    if (requiresAuth && !isAuthenticated) {
        next('/login')
    } else {
        // fetch user
        if(isAuthenticated) {
            store.dispatch('getMe')
        }
        next()
    }
})

export default router
