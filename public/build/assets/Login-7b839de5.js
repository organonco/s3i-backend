import{T as g,r as o,o as x,c as V,a as e,w as t,u as n,Z as k,b as l,d as y,F as B,e as F}from"./app-bdcf9ddf.js";const N=F("title",null," تسجيل الدخول ",-1),T={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(S){const s=g({username:"",password:"",remember:!1}),d=()=>{s.post(route("login"),{onFinish:()=>s.reset("password")})};return(q,a)=>{const c=o("v-toolbar-title"),m=o("v-toolbar"),_=o("v-text-field"),u=o("v-btn"),p=o("v-form"),i=o("v-card-text"),f=o("v-card"),v=o("v-col"),b=o("v-row"),w=o("v-container");return x(),V(B,null,[e(n(k),null,{default:t(()=>[N]),_:1}),e(w,{fluid:""},{default:t(()=>[e(b,{align:"center",justify:"center",class:"ma-16"},{default:t(()=>[e(v,{cols:"12",sm:"8",md:"3"},{default:t(()=>[e(f,{class:"elevation-12"},{default:t(()=>[e(m,{dark:"",flat:""},{default:t(()=>[e(c,null,{default:t(()=>[l("تسجيل الدخول")]),_:1})]),_:1}),e(i,null,{default:t(()=>[e(p,{onSubmit:y(d,["prevent"])},{default:t(()=>[e(_,{modelValue:n(s).username,"onUpdate:modelValue":a[0]||(a[0]=r=>n(s).username=r),label:"اسم المستخدم",type:"text",required:"","error-messages":n(s).errors.username},null,8,["modelValue","error-messages"]),e(_,{modelValue:n(s).password,"onUpdate:modelValue":a[1]||(a[1]=r=>n(s).password=r),label:"كلمة المرور",type:"password",required:"","error-messages":n(s).errors.password},null,8,["modelValue","error-messages"]),e(u,{disabled:n(s).processing,color:"black",block:"",type:"submit"},{default:t(()=>[l("تسجيل الدخول")]),_:1},8,["disabled"])]),_:1},8,["onSubmit"])]),_:1})]),_:1})]),_:1})]),_:1})]),_:1}),l("` ")],64)}}};export{T as default};
