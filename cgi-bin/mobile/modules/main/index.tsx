// withHooks
import { memo, useState } from 'react';

import { createStackNavigator } from '@react-navigation/stack';
import navigation from 'esoftplay/modules/lib/navigation';
import React from 'react';
import { Button, View } from 'react-native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { Ionicons } from '@expo/vector-icons';
import { NavigationContainer } from '@react-navigation/native';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import home from '../teacher/home';
import attendece from '../teacher/attenreport';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { Auth } from '../auth/login';




export interface MainIndexArgs {

}
export interface MainIndexProps {

}
function m(props: MainIndexProps): any {
  const Tab = createBottomTabNavigator();

  const [isSignedIn] = Auth.useSelector(data => [data.isLogin,{ persistKey: 'auth' }])
  const [loginAs]=Auth.useSelector(data=>[data.status,{persistKey:'auth'}])

  
    if (isSignedIn==true && loginAs=="teacher") {
      LibNavigation.navigate('teacher/index');
    }else if (isSignedIn==true && loginAs=="parent") {
      console.log("login as parent")
      LibNavigation.navigate('teacher/index');
    } 
    else {
      LibNavigation.navigate('onboarding/onboarding');
    }
  // return (
  //   <View style={{ flex: 1, backgroundColor: 'white', alignContent: 'center',justifyContent:'center'}}>
  //     <Button title="Go to Login" onPress={() => {navigation.navigate('auth/login',console.log("click"))}} />
  //   </View>    
  // ) 
}
export default memo(m);