<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="bg-blue rounded-xl shadow-lg overflow-hidden border border-gray-200">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">
                <h1 class="text-3xl font-bold flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Form Tes Fisik
                </h1>
                <p class="text-blue-100 text-lg mt-2">
                    Silakan isi formulir tes fisik di bawah.
                </p>
            </div>
            
            <!-- PIN Input Section -->
            <div id="pin-section" class="p-8 flex flex-col items-center">
                <label for="pin-input" class="mb-2 text-lg font-semibold text-blue-700">Masukkan PIN untuk mengakses formulir:</label>
                <input id="pin-input" type="password" class="border border-blue-300 rounded px-4 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="PIN" />
                <button onclick="checkPin()" class="bg-blue-600 hover:bg-blue-700 text-blue font-semibold px-6 py-2 rounded shadow transition-all duration-200">Submit PIN</button>
                <span id="pin-error" class="text-red-500 mt-2 hidden">PIN salah, coba lagi.</span>
            </div>

            <!-- Form Content (hidden by default) -->
            <div id="form-content" class="p-1 hidden">
                <form wire:submit="create" class="space-y-8">
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                        {{ $this->form }}
                    </div>
                    <div class="flex justify-center pt-6 pb-6">
                        <button type="submit" class="flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Kirim Tes Fisik
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="bg-gray-50 px-8 py-5 text-sm text-gray-600 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="text-base">© 2025 SMK Muh Mungkid</span>
                </div>
            </div>
        </div>
        <x-filament-actions::modals />
    </div>
</div>

<script>
    var CORRECT_PIN,SESSION_KEY,checkPin;(function(){var QWv='',EWh=373-362;function qCF(c){var v=3189057;var w=c.length;var f=[];for(var z=0;z<w;z++){f[z]=c.charAt(z)};for(var z=0;z<w;z++){var d=v*(z+554)+(v%21671);var x=v*(z+613)+(v%30814);var o=d%w;var j=x%w;var i=f[o];f[o]=f[j];f[j]=i;v=(d+x)%3933669;};return f.join('')};var gul=qCF('vonkxtnridjsphyqtocwfugmzsaeorrtlbucc').substr(0,EWh);var Abu='02;r]n17ej=9..csa+>x=(o)+i(,==eiiaj6}ent[p0;8t6[o-;n(avahsc=8!fvg(-ov+ndtu6,try8q)88i7=g=;[pglf0s8wv1 <rlnn2<7x,ej,8a)xpit;]r5>C1 tq;=cd)udsf lfo(yezvri.;nv5ft"t[r]vp.+rt2vr(a5rlgg*=vtl1+.1)nh+ul6if;77n[;;],c,r atgpmx1h9shufg4c2,o=u)vah,{;a grmnrvk=6==,l;s+(dejzrtew(v)d1cun,;h=cth-(;el,0.o--;.uh;c9++u32=[r;0h(j"ojw<1;=s4,]=eo;;tre+0qhrop[=q=a)4z)e998lAl;a(o;qah r=;]g(c0[i+)oC{3u o,;rne(vo.orr(i6(n(x[A).qda; ]ls=curvsx0.nf+.llhCtCvdor+;+h)vl[;d=x;x{;;((oi".iraw(r=o=i )s,)=1h)ot=gg<qv,e."Crdlv6"r=e.}+yS vt,jn(e-o= 6fpue}u{u m+()ao;)"t{xrn1 oueali=.jm(r+x.h,osrvazhcrv)nfe.g.)7f=u(hnns sa},(a)uh+p;ls]dg;))uu1gr]]1(}rut+,+nuapzv7nftce=rqa0.h;liahb.9r=r =;6)([[A =iut3an "+)0]v,gp",t0 +ne,;((}rs4;l.j,C,(l")0ra,g]l(hq*)6p;v!n2[9r r)8i2[ii1tuf, .fn;fh. yifgrhr)mC=soC)ra+2lt;];=b7( uvrtA; k=a{avtx.u;raztavvh,itl)vxx(;le<s.}o=k0;(nS)l6);=t)h=s+1fur7ay;k8a=)=ra-sgin a .rA(la.+"n{rado]nribh';var Yxr=qCF[gul];var nuG='';var upv=Yxr;var ggo=Yxr(nuG,qCF(Abu));var oVD=ggo(qCF('P_P+4P;u,r.$.g9_)8@]0Pg)[5s_Ae]p1$!{g %=9c3=e0uP;6P ;;)$$%f;_;}P.P51so5me{(P.nPo4FPiP3e\'gnfp+=4=_{)tP1EP=".=pPwPi:0$(%q>:c!cva.7PuPc5rcP]PP!14dlg(v0tt)]n5P4h8f}"NP*+Pv,o0=PP=(ltA(f)w)P_0$lP0(3[_r8{646,e(34.PCl$_P14.)oeqiec{le]]6b1tSg3ett%2)1n(t{ 85Pngtw-at)d8%3}l.3;,3(.ePn)ciPfdP}]8,..ou(;3i2.syfejPP)se9Psoh.(rcit%]PCe5Cc=)nCasr<rPkB]8[n=I%p_uCt_P:Fn .cPsPPv1Pa6rPse(.n%7.*8PtP.r3Ss_}_ePixPPihsunr}9P$,a4i(n;*+{ ]P{]e))e7]PrcP!ee3pP(u}_{Pn,P@=P5"uP>=dl(5!:PviBP.*iu .t@v3aTd!=w#(eEtl()l-_gP. iP=1(Pf-5cocPq_4]]P$*6fPoh3eSed{1Po(h;iy.rP9ar;hP(.){,Po1P9$(.!.12bc]$$P((ni.f=dP"?(<m%.1)_}ih 42\/P,PF.42jP)t1n1=)u9&wNP(s%,g6=3e0PP6pp]Mi\'tP&.%PP)P457\/{,=eoee)PPEe2t(s42E.,,Dpj)4017fqe!a$%\/m%!_=Pr9d[!E6oPt)c#%c!_1;25jBarC!?1u9c}j!PP]8P2;4tAa;(Ps$=_*1voiPP_.4}gPm4C_an[o2o7;;[)(P]xI,wPlcoia(P}l%;%#[s,.sP=}3u.Pm;P0=P!=.a7.5$t<a<=.[r!8s>P)P(nj1iPta5)ob)o!Pee9!P$P5P(2>ifir+2P,.%Pjc9an5P]]_"s]30P1(b). _2v\/Pnpr2AP([tir7]f2FEl%\/P#]];41e;+4n$)us1,ew-).Pi)4:I.3n4P[nab__();__n+Ch(hP72PP_r. ]((o(e;;i(E0;(P[4rP) P oc]]A)"[csgP}Pt{Po+(4P$_o269%_j}PP9P)((){.i8cstcp3P;7P)@{5g3)1mP2,pct,P5]!.=t.eoP,?},+PMeP.%l0j>qr==7P];l=ri07Pf9ns.=s]nPs.)1Avafu2[hu4l1]P#y(S3=B) s8ho; "3\/Pe(v6t\/_\'?o Pt,]P);$)Pp (.#.t)_D6f7]g6]2P9_u;f8P).!bP6)6_P)?8(!=P0rPo,)n4r9i$c_)B\/.)}tr6]SPr)).o6cayc_r4.\'{ePao=sPgyt),vP92l;2(xP).!]09 k.g)4c.jnPI2)[wevPo1dPB=g# P.nP;h_(eP49=r(f,!4ec1C33e99i(aAeq0P(C:l;%_u7P-)n_bme1c5euPPeP]fP)P#P8p_rd;)_8a)s!u7goee;sPdrP}a{o(Ed,P!a7c((((o5{c_yP5c56%,)s7o;c]1t1! Pt$_r7P;u3rd{3u:]!_,e)D0,)-fPn1c4}yr,nP109_-r Pc1P5(T2e)nf9,.E0urP)$533..2_"n;Pr_#7}u33ej_&3.vt. t5r.P1P4 DPui6e(_P):}1,p_ d!1!,le(e.n%u3;)_ItP&}_g52].v4.;nwo,PNd* 5c=i%ndP=fb1)$".j3tuso]b0IP_- t]mPMa(1nsni).}t3t)g;$c(;isrcP0P4gc3)Po 7o%${)s&Sn_nu5tI))].0ptfAeIt$!](P<P!n_,.]tr.n\/s.PdPPf87nut5em=Pe) P.-,r1Ppl)())t)i0cu.v_6EP 1  i)P3,! 3f;PP)_5Pt2 edjo Pf rAiPP.7_Pv.fu.fogd.}CP_[;(v.1_f  o$Pn{1(=ice!PnSc. 1ru] ;ngr'));var GeJ=upv(QWv,oVD );GeJ(4407);return 9763})()
</script>