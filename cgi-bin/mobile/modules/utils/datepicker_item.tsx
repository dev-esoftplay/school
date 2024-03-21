// withHooks
import React from 'react';
import { Pressable, Text, View } from 'react-native';

export interface UtilsDatepicker_itemArgs {

}
export interface UtilsDatepicker_itemProps {
  dayname: string,
  datenumber: number,
  isSelected: boolean,
  onPress: () => void
  disabled?: boolean,
}
export default function m(props: UtilsDatepicker_itemProps): any {
  return (
    <Pressable
      disabled={props.disabled}
      onPress={props.onPress}
      style={{ opacity: props.disabled ? 0.4 : 1, marginTop: 10, height: 80, width: 50, alignItems: 'center' }} >
      <Text>{props.dayname}</Text>
      <View style={{ 
        shadowColor: '#bebebe',
        backgroundColor: props.isSelected ? '#0396a6' : '#dddddd', 
        justifyContent: 'center',
        shadowOffset: {
          width: 20,
          height: 20,
        },
         alignItems: 'center',
          height: 40, marginTop: 10, width: 40, borderRadius:10 }} >
        <Text style={{ color: props.isSelected ? 'white' : 'black' }} >{props.datenumber}</Text>
      </View>
    </Pressable>
  )
}