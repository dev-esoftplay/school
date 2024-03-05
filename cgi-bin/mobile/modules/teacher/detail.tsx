// withHooks
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import React, { memo, useEffect, useRef, useState } from 'react';

import { Image, Platform, View, Text, TouchableOpacity, Pressable, Touchable, TextInput } from 'react-native';
import { MaterialIcons } from '@expo/vector-icons';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import navigation from 'esoftplay/modules/lib/navigation';
import { UserClass } from 'esoftplay/cache/user/class/import';
import { LibLocale } from 'esoftplay/cache/lib/locale/import';
import { LibSlidingup } from 'esoftplay/cache/lib/slidingup/import';
import { LibImage } from 'esoftplay/cache/lib/image/import';
import useSafeState from 'esoftplay/state';
import esp from 'esoftplay/esp';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibProgress } from 'esoftplay/cache/lib/progress/import';
import teacher from '.';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';

export interface TeacherDetailArgs {

}
export interface TeacherDetailProps {

}
function m(props: TeacherDetailProps): any {

    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: 'black', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
        }
        return { elevation: value };
    }
    const name: string = UserClass.state().get().name
    const data = UserClass.state().get()
    let slideup = useRef<LibSlidingup>(null)
    let [image, setImage] = useSafeState<string | null>(null)
    let images: string = String(image) ?? '../../assets/anies.png'
    const [username, setUsername] = useSafeState('');
    const [resApi, setResApi] = useState<any>([])
    useEffect(() => {
        new LibCurl('teacher', get, (result, msg) => {
            esp.log({ result, msg });
            console.log("result", result)
            setResApi(result)
        }, (err) => {
            esp.log({ err });
            LibDialog.warning('get data gagal', err?.message)
        }, 1)
    }, [])

    function updateData() {
        LibProgress.show()
        const post = {
            name: username
        }
        console.log("post", post)
        new LibCurl('teacher_update', post, (result, msg) => {

            LibProgress.hide()
            esp.log({ result, msg });
            console.log("result", result)
            LibDialog.info('Update Berhasil', result)


        }, (err) => {
            esp.log({ err });
            LibProgress.hide()
            LibDialog.warning('Login Gagal', err?.message)
        }, 1)
    }
    return (
        <View style={{ marginTop: LibStyle.STATUSBAR_HEIGHT, ...elevation(6), flex: 1, paddingHorizontal: 20 }}>

            <View style={{ justifyContent: 'flex-start', alignSelf: 'flex-start', marginTop: 5, }}>
                <TouchableOpacity style={{ alignSelf: 'center', flexDirection: 'row' }} onPress={() => LibNavigation.back()}>
                    <MaterialIcons name='arrow-back-ios' size={30} color='#000000' />
                    <Text style={{ color: '#000000', fontSize: 20, fontWeight: 'bold' }}>kembali</Text>
                </TouchableOpacity>
            </View>

            <View style={{ justifyContent: 'center', alignItems: 'center', marginTop: 10 }}>
                <View style={{}}>
                    <Image source={image ? { uri: image } : esp.assets('anies.png')} style={{ width: 135, height: 135, borderRadius: 135 / 2, borderWidth: 3, borderColor: '#FFFFFF' }} />
                    <Pressable
                        onPress={() => slideup.current?.show()}
                        style={{
                            position: 'absolute',
                            bottom: 0, right: -5,
                            borderRadius: 45 / 2,
                            backgroundColor: '#136B93',
                            width: 45, height: 45, justifyContent: 'center', alignItems: 'center',
                            elevation: 3, shadowColor: '#000',
                            shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2
                        }}>
                        <MaterialIcons name='edit' size={20} color='#FFFFFF' />
                    </Pressable>

                </View>
                <Text style={{ color: '#000000', fontWeight: 'bold', fontSize: 20, textAlign: 'center', padding: 10 }}>{resApi?.name ?? 'name'}</Text>
            </View>

            <View style={{ flexDirection: 'row', marginTop: 10, marginHorizontal: 20, }}>
                <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#136B93', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 10 }}>
                    <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Guru IPA</Text>
                </TouchableOpacity>

                <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#136B93', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginLeft: 10 }}>
                    <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>{resApi?.position ?? 'position'}</Text>
                </TouchableOpacity>
            </View>

            <View style={{ marginHorizontal: 20, }}>
                <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 30, alignContent: 'flex-start', textAlign: 'left' }}>Email Pengajar</Text>
                <View style={{ width: '100%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#fff', shadowColor: '#000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>

                    <TextInput placeholder={resApi?.name ?? 'name'} onChangeText={(text) => setUsername(text)} />
                </View>


                <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, alignContent: 'flex-start', textAlign: 'left' }}>NIP Pengajar</Text>
                <View style={{ width: '100%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#fff', shadowColor: '#000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                    <Text style={{ alignContent: 'flex-start', textAlign: 'left', color: '#898989' }}>{resApi?.nip ?? 'name'}</Text>
                </View>

                <Pressable onPress={() => updateData()} style={{ width: '100%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#107ac0', shadowColor: '#000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2, marginTop: 15 }}>
                    <Text style={{ alignContent: 'flex-start', textAlign: 'center', color: '#ffffff' }}>Update Data</Text>
                </Pressable>
            </View>
            <LibSlidingup ref={slideup} >
                <View style={{ backgroundColor: 'white', borderTopRightRadius: 20, borderTopLeftRadius: 20, paddingBottom: 35, paddingHorizontal: 19, }}>
                    <Text allowFontScaling={false} style={{ marginTop: 26, marginBottom: 23, fontFamily: "Arial", fontSize: 16, fontWeight: "bold", fontStyle: "normal", lineHeight: 22, letterSpacing: 0, textAlign: "center", color: "#34495e" }}></Text>
                    <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginBottom: 27 }}>

                        <TouchableOpacity
                            style={{ width: 50, height: 50, backgroundColor: '#2acf40', borderRadius: 50, justifyContent: 'center', alignItems: 'center' }}
                            onPress={() =>
                                LibImage.fromCamera({ crop: { ratio: "1:1", forceCrop: true } }).then((url) => {
                                    slideup.current!.hide()
                                    setImage(url)
                                })} >
                            <Text>Camera</Text>
                        </TouchableOpacity>

                        <TouchableOpacity
                            style={{ width: 50, height: 50, backgroundColor: '#d2c620', borderRadius: 50, justifyContent: 'center', alignItems: 'center' }}
                            onPress={() =>
                                LibImage.fromGallery({ crop: { ratio: "1:1", forceCrop: true } }).then((url) => {
                                    esp.log(url)
                                    slideup.current!.hide()
                                    setImage(String(url))
                                })} >
                            <Text>Gallery</Text>
                        </TouchableOpacity>



                    </View>
                </View>
            </LibSlidingup>
        </View>
    )
}
export default memo(m)