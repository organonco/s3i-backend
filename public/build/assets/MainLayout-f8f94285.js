import{r as o,o as s,c as _,a as e,w as t,e as v,t as m,u as r,Z as k,q as p,b,F as f,g as w,f as B,k as V}from"./app-2855b29f.js";const $=[{icon:"mdi-bookshelf",title:"الكورسات",route:"course.index",value:"course"},{icon:"mdi-account-school",title:"الطلاب",route:"student.index",value:"student"},{icon:"mdi-account",title:"المعلمين",route:"teacher.index",value:"teacher"},{icon:"mdi-key",title:"الأكواد",route:"course_token.index",value:"course_token"},{icon:"mdi-shape",title:"أقسام الكورسات",route:"category.index",value:"category"},{icon:"mdi-earth",title:"الجنسيات",route:"nationality.index",value:"nationality"},{icon:"mdi-school",title:"المستويات الدراسية",route:"education_level.index",value:"education_level"},{icon:"mdi-account-key",title:"تغيير كلمة المرور",route:"profile.edit",value:"profile"}],M=[{icon:"mdi-cast-education",title:"لوحة التحكم",route:"classroom.index",value:"classrooms"},{icon:"mdi-account-key",title:"تغيير كلمة المرور",route:"profile.edit",value:"profile"}],N="1.1.4",S={props:{title:String},data(){return{listItems:this.$page.props.auth.user.super_admin?$:M}}},L=Object.assign(S,{__name:"MainLayout",setup(i){return(a,C)=>{const l=o("v-list-item"),c=o("v-divider"),h=o("v-list"),g=o("v-navigation-drawer"),u=o("v-row"),d=o("v-container"),y=o("v-main"),x=o("v-layout");return s(),_(f,null,[e(r(k),null,{default:t(()=>[v("title",null," "+m(i.title)+" ",1)]),_:1}),e(x,null,{default:t(()=>[e(g,{"expand-on-hover":"",rail:"",location:"right",class:"text-right"},{prepend:t(()=>[e(l,{lines:"two","prepend-icon":"mdi-account",title:a.$page.props.auth.user.name},{default:t(()=>[e(r(p),{as:"a",class:"text-black",href:a.route("logout"),method:"post"},{default:t(()=>[b(" تسحيل الخروح")]),_:1},8,["href"])]),_:1},8,["title"])]),default:t(()=>[e(c),e(h,{density:"compact",nav:""},{default:t(()=>[(s(!0),_(f,null,w(a.listItems,n=>(s(),B(r(p),{as:"div",href:a.route(n.route)},{default:t(()=>[e(l,{variant:"text","active-color":"secondary",as:"v-list-item","prepend-icon":n.icon,title:n.title,value:n.value,active:n.value===a.$page.props.metadata.route},null,8,["prepend-icon","title","value","active"])]),_:2},1032,["href"]))),256))]),_:1}),e(l,{class:"position-absolute",style:{bottom:"0"},variant:"text",title:"V"+N},null,8,["title"])]),_:1}),e(y,null,{default:t(()=>[e(d,{class:""},{default:t(()=>[e(u,{class:"mt-12 mb-6 mx-2"},{default:t(()=>[v("h1",null,m(i.title),1)]),_:1}),e(c,{class:"my-8"}),e(u,null,{default:t(()=>[e(d,null,{default:t(()=>[V(a.$slots,"default")]),_:3})]),_:3})]),_:3})]),_:3})]),_:3})],64)}}});export{L as _};