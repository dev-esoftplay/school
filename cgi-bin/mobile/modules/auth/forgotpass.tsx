// withHooks
import { memo } from 'react';

import React from 'react';
import { Image, ScrollView, View } from 'react-native';


export interface AuthForgotpassArgs {
  
}
export interface AuthForgotpassProps {
  
}
function m(props: AuthForgotpassProps): any {
  return (
    <View style={{ flex:1 ,backgroundColor: "white",alignContent:'center'}}>
    <ScrollView style={{ flex: 1,paddingHorizontal: 30 }} showsVerticalScrollIndicator={false}>
    <Image source={require('/home/yasin/tmp/school/cgi-bin/mobile/assets/lupapass.png')}
        style={{ alignSelf: 'center', marginTop: 75 }} />
    </ScrollView>
    </View>
  )
}
export default memo(m);