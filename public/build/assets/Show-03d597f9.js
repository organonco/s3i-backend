import{_ as k}from"./MainLayout-14f73f89.js";import{C as y}from"./CenterSheet-c32fda75.js";import{r as l,o as r,f as v,w as t,a as e,c as g,g as b,b as i,t as V,F as h,T as x}from"./app-bdcf9ddf.js";const C={data(){},methods:{resetLoginAttempts:function(n){x({}).put(route("student.unfreeze",{student:n}))}}},L=Object.assign(C,{__name:"Show",props:{student:Object},setup(n){const u=[{icon:"mdi-account",key:"name_ar",name:"الاسم"},{icon:"mdi-account",key:"name_en",name:"الاسم باللغة الانكليزية"},{icon:"mdi-phone",key:"phone",name:"رقم الهاتف"},{icon:"mdi-email",key:"email",name:"البريد الالكتروني"},{icon:"mdi-calendar",key:"date_of_birth",name:"تاريخ الميلاد"},{icon:"mdi-earth",key:"nationality",name:"الجنسية"},{icon:"mdi-school",key:"education_level",name:"المستوى الدراسي"},{icon:"mdi-map-marker",key:"address",name:"العنوان"},{icon:"mdi-information-variant",key:"reference",name:"كيف علمت عنا"},{icon:"mdi-calendar",key:"created_at",name:"تاريخ الانضمام"}];return(_,d)=>{const m=l("v-icon"),o=l("v-col"),c=l("v-text-field"),s=l("v-row"),f=l("v-btn");return r(),v(k,{title:"عرض بطاقة الطالب"},{default:t(()=>[e(y,{cols:"4"},{default:t(()=>[(r(),g(h,null,b(u,a=>e(s,null,{default:t(()=>[e(o,{cols:"1","align-self":"center"},{default:t(()=>[e(m,null,{default:t(()=>[i(V(a.icon),1)]),_:2},1024)]),_:2},1024),e(o,{cols:"11","align-self":"center"},{default:t(()=>[e(c,{variant:"outlined",label:a.name,modelValue:n.student.data[a.key],"onUpdate:modelValue":p=>n.student.data[a.key]=p,readonly:"","hide-details":""},null,8,["label","modelValue","onUpdate:modelValue"])]),_:2},1024)]),_:2},1024)),64)),e(s,{justify:"space-around"},{default:t(()=>[e(o,{cols:"1","align-self":"center"},{default:t(()=>[e(m,null,{default:t(()=>[i("mdi-login")]),_:1})]),_:1}),e(o,{cols:"7","align-self":"center"},{default:t(()=>[e(c,{variant:"outlined",label:"عدد مرات تسجيل الدخول",modelValue:n.student.data.number_of_login_attempts,"onUpdate:modelValue":d[0]||(d[0]=a=>n.student.data.number_of_login_attempts=a),readonly:"","hide-details":""},null,8,["modelValue"])]),_:1}),e(o,{cols:"4","align-self":"center"},{default:t(()=>[e(f,{"append-icon":"mdi-lock-reset",variant:"text",color:"primary",onClick:d[1]||(d[1]=a=>_.resetLoginAttempts(n.student.data.id))},{default:t(()=>[i("اعادة التعيين ")]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})}}});export{L as default};
