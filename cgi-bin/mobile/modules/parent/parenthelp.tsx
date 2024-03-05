// withHooks

import React from 'react';
import { memo } from 'react';
import { Platform, View, TouchableOpacity, Text } from 'react-native';
import { MaterialIcons, Feather } from '@expo/vector-icons';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';


export interface ParentHelpArgs {

}
export interface ParentHelpProps {

}
function m(props: ParentHelpProps): any {
    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: '#000000', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
        }
        return { elevation: value };
    }
    return (
        <View style={{ marginTop: 60, ...elevation(6) }}>

            <View style={{ justifyContent: 'flex-start', alignItems: 'flex-start', marginTop: 5 }}>
                <TouchableOpacity onPress={() => LibNavigation.back()} style={{ position: 'absolute', marginTop: -40, marginLeft: -185 }}>
                    <MaterialIcons name='arrow-back-ios' size={30} color={'#000000'} />
                </TouchableOpacity>
            </View>

            <View style={{ marginTop: 15, marginLeft: 15, marginRight: 15 }}>
                <Text style={{ fontSize: 28, fontWeight: '500' }}>We're here to help you with anything and everything on School</Text>
            </View>

            <View style={{ marginTop: 20, marginHorizontal: 15 }}>
                <Text style={{ fontSize: 14, color: '#757575' }}>At School we expect at a day's is you, better and happier than yesterday. We have got you covered share your concern or check our frequently asked questions listed below.</Text>
            </View>

            <View style={{ flexDirection: 'row', marginTop: 25, marginHorizontal: 20 }}>
                <TouchableOpacity disabled={true} style={{ flex: 1, flexDirection: 'row', paddingVertical: 10, backgroundColor: '#FFFFFF', alignItems: 'flex-start', borderRadius: 10, ...elevation(6) }}>
                    <MaterialIcons name='search' size={25} color={'#000000'} style={{ marginLeft: 15 }} />
                    <Text style={{ fontSize: 15, marginLeft: 15, color: '#757575' }}>Search Help</Text>
                </TouchableOpacity>
            </View>

            <View style={{ alignItems: 'flex-start', alignContent: 'flex-start', justifyContent: 'flex-start', marginTop: 20, marginHorizontal: 15 }}>
                <Text style={{ fontSize: 17, fontWeight: 'bold', alignItems: 'flex-start', alignContent: 'flex-start' }}>FAQ</Text>
            </View>

            <View style={{ width: 'auto', height: 2, backgroundColor: '#D5D5D5', opacity: 1, marginTop: 10 }} />

            <View style={{ flexDirection: 'row', alignItems: 'flex-start', alignContent: 'flex-start', justifyContent: 'flex-start', marginTop: 20, marginHorizontal: 15 }}>
                <Text style={{ fontSize: 15, fontWeight: '700', alignItems: 'flex-start', alignContent: 'flex-start' }}>What is School?</Text>

                <View style={{ justifyContent: 'flex-end', alignItems: 'flex-end', marginLeft: 220 }}>

                    <Feather style={{ justifyContent: 'space-between' }} name="plus" size={30} color={'#a8a8a8'} />

                </View>
            </View>

            <View style={{ marginTop: 5 }}>
                <Text style={{ fontSize: 14, color: '#757575', marginHorizontal: 15 }}>At School we expect at a day start is you better and happier than yesterday, We have got you covered share your concern or check out frequently asked questions listed below. At School we expect at a days start is you, better and happier than yesterday. We have got you covered share your concern.</Text>
            </View>

            <View style={{ width: 'auto', height: 2, backgroundColor: '#D5D5D5', opacity: 1, marginTop: 10 }} />

            <View style={{ flexDirection: 'row', alignItems: 'flex-start', alignContent: 'flex-start', justifyContent: 'flex-start', marginTop: 20, marginHorizontal: 15 }}>
                <Text style={{ fontSize: 15, fontWeight: '700', alignItems: 'flex-start', alignContent: 'flex-start' }}>How to apply for Absen</Text>

                <View style={{ justifyContent: 'flex-end', alignItems: 'flex-end', marginLeft: 163 }}>

                    <Feather name="plus" size={30} color={'#a8a8a8'} />

                </View>
            </View>

            <View style={{ width: 'auto', height: 2, backgroundColor: '#D5D5D5', opacity: 1, marginTop: 10 }} />

        </View>
    )
}
export default memo(m);