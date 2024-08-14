import{_ as g}from"./MainLayout-878f3cbb.js";import{C as y}from"./CenterSheet-4bff3cd2.js";import{r as d,o as f,f as b,w as t,a as e,c as w,g as V,b as r,t as h,F as C,e as B,T as p}from"./app-92c60662.js";const j=B("br",null,null,-1),U={computed:{requiredRule:function(){return[o=>!!o||"Required"]}},data(){return{form:p({attempts:this.student.data.number_of_login_attempts}),pwd_form:p({password:null}),modal:!1}},methods:{resetLoginAttempts:function(o){this.form.put(route("student.unfreeze",{student:o})),this.form.attempts==this.student.data.number_of_login_attempts&&(this.form.attempts=0)},submitpwd:function(){this.pwd_form.put(route("student.reset_password",{student:this.student.data.id}))},opendialog:function(){this.modal=!0}}},$=Object.assign(U,{__name:"Show",props:{student:Object,success:Boolean},setup(o){const _=[{icon:"mdi-account",key:"name_ar",name:"الاسم"},{icon:"mdi-account",key:"name_en",name:"الاسم باللغة الانكليزية"},{icon:"mdi-phone",key:"phone",name:"رقم الهاتف"},{icon:"mdi-email",key:"email",name:"البريد الالكتروني"},{icon:"mdi-calendar",key:"date_of_birth",name:"تاريخ الميلاد"},{icon:"mdi-earth",key:"nationality",name:"الجنسية"},{icon:"mdi-school",key:"education_level",name:"المستوى الدراسي"},{icon:"mdi-map-marker",key:"address",name:"العنوان"},{icon:"mdi-information-variant",key:"reference",name:"كيف علمت عنا"},{icon:"mdi-calendar",key:"created_at",name:"تاريخ الانضمام"}];return(l,a)=>{const u=d("v-icon"),s=d("v-col"),i=d("v-text-field"),m=d("v-row"),c=d("v-btn"),v=d("v-divider");return f(),b(g,{title:"عرض بطاقة الطالب"},{default:t(()=>[e(y,{cols:"4"},{default:t(()=>[(f(),w(C,null,V(_,n=>e(m,null,{default:t(()=>[e(s,{cols:"1","align-self":"center"},{default:t(()=>[e(u,null,{default:t(()=>[r(h(n.icon),1)]),_:2},1024)]),_:2},1024),e(s,{cols:"11","align-self":"center"},{default:t(()=>[e(i,{variant:"outlined",label:n.name,modelValue:o.student.data[n.key],"onUpdate:modelValue":k=>o.student.data[n.key]=k,readonly:"","hide-details":""},null,8,["label","modelValue","onUpdate:modelValue"])]),_:2},1024)]),_:2},1024)),64)),e(m,{justify:"space-around"},{default:t(()=>[e(s,{cols:"1","align-self":"center"},{default:t(()=>[e(u,null,{default:t(()=>[r("mdi-login")]),_:1})]),_:1}),e(s,{cols:"7","align-self":"center"},{default:t(()=>[e(i,{variant:"outlined",label:"عدد مرات تسجيل الدخول",modelValue:l.form.attempts,"onUpdate:modelValue":a[0]||(a[0]=n=>l.form.attempts=n)},null,8,["modelValue"])]),_:1}),e(s,{cols:"4","align-self":"center"},{default:t(()=>[e(c,{"append-icon":"mdi-lock-reset",variant:"text",color:"secondary",onClick:a[1]||(a[1]=n=>l.resetLoginAttempts(o.student.data.id))},{default:t(()=>[r("اعادة التعيين ")]),_:1})]),_:1})]),_:1}),e(m,{justify:"space-around"},{default:t(()=>[e(v),j,e(s,{cols:"7","align-self":"center"},{default:t(()=>[e(i,{variant:"outlined",label:"كلمة المرور",modelValue:l.pwd_form.password,"onUpdate:modelValue":a[2]||(a[2]=n=>l.pwd_form.password=n),"error-messages":l.pwd_form.errors.password},null,8,["modelValue","error-messages"])]),_:1}),e(s,{cols:"5","align-self":"center"},{default:t(()=>[e(c,{"append-icon":"mdi-account-lock",variant:"text",color:"error",onClick:a[3]||(a[3]=n=>l.submitpwd())},{default:t(()=>[r("إعادة تعيين كلمة المرور ")]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})}}});export{$ as default};