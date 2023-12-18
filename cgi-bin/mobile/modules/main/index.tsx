// withHooks
import { memo } from 'react';

import { createStackNavigator } from '@react-navigation/stack';
import navigation from 'esoftplay/modules/lib/navigation';
import React from 'react';
import { Button, View } from 'react-native';




export interface MainIndexArgs {

}
export interface MainIndexProps {

}
function m(props: MainIndexProps): any {
  return (
    <View style={{ flex: 1, backgroundColor: '#58fd58', justifyContent:"center"}}>
      <Button title="Go to Onboarding" onPress={() =>
  {    console.log("clicked"),
      navigation.navigate('onboarding/onboarding')}
      } />
    </View>
  )
}
export default memo(m);