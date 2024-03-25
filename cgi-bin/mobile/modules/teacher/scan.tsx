// withHooks
import { memo } from 'react';

import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibLazy } from 'esoftplay/cache/lib/lazy/import';
import { LibLoading } from 'esoftplay/cache/lib/loading/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import useSafeState from 'esoftplay/state';
import { Camera } from 'expo-camera';
import React, { useEffect, useRef } from 'react';
import { Pressable, Text, View } from 'react-native';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import esp from 'esoftplay/esp';

export interface TeacherScanArgs {}
export interface TeacherScanProps {}

function m(): any {
 let isScanned = useRef<boolean>(false);
  const [hasPermission, setHasPermission] = useSafeState();
  let [result, setResult] = useSafeState<any>(null);
  const [ApiResponse, setResApi] = useSafeState<any>();
  useEffect(() => {
    new LibCurl('teacher_schedule', null,
    (result) => {
       console.log('Jadwal Result:', result);
      // console.log("msg", msg)
      setResApi(result)
     
    },
    () => {
      // console.log("error", err)
    }),
    (async () => {
      let { status } = await Camera.getCameraPermissionsAsync();
      if (status !== 'granted') {
        status = (await Camera.requestCameraPermissionsAsync()).status;
      }
      setHasPermission(status === 'granted');
    })();

    
  }, []);

  if (hasPermission === null) {
    return <View> <Text>hasPermission is null</Text></View>;
  }
  let schedule_id = ApiResponse?.schedule[0]?.data[0].schedule_id;
  let class_id = ApiResponse?.schedule[0]?.data[0].class.id;
  let course_id = ApiResponse?.schedule[0]?.data[0].course.id;
  function onBarCodeScanned({ data }: any): void {
    setResult(data);
    // console.log( ApiResponse?.schedule[0]?.data[0].schedule_id,)
    
    if (data == 'http://api.test.school.esoftplay.com/student_class?class_id='+class_id) {
      // console.log('http://api.test.school.esoftplay.com/student_class?class_id='+class_id);
       console.log('data :', data);
      // console.log('data is string');
      LibNavigation.navigate('teacher/scanattandence' ,{ url: data , schedule_id: schedule_id, class_id: class_id, course_id: course_id});
    }else{
      esp.log(esp.logColor.red, 'QR Code tidak valid',result);
     LibDialog.warning('QR Code tidak valid',"Anda tidak mengajar kelas ini pada jam ini");
    }
    
  }


  // Fungsi untuk memulai pemindaian ulang
  const startScanningAgain = () => {
    isScanned.current = false; // Reset status pemindaian
    console.log('startScanningAgain');
    isScanned.current= true;
    setResult(null); // Reset hasil pemindaian
  };

  return (
    <View style={{ flex: 1 }}>
      {hasPermission === true ?
        <View style={{ flex: 1, backgroundColor: "#000000" }} >
          <LibLazy>
            <Camera
              onBarCodeScanned={
                isScanned ? onBarCodeScanned : onBarCodeScanned
              }
              ratio={'16:9'}
              style={{ height: LibStyle.height, width: LibStyle.width }}>
            
              <View style={{ flex: 1, backgroundColor: 'transparent', justifyContent: 'center', alignItems: 'center', borderRadius: 15 }}>
                {/* {result} {cekscan} */}
                <Text style={{ color: '#ffffff', fontSize: 20, fontWeight: 'bold', marginBottom: 20 }}>Scan QR Code  </Text>
                <View style={{ width: LibStyle.width * 0.8, height: LibStyle.width * 0.8, borderWidth: 1, borderColor: '#ffffff', borderRadius: 15 }} />
              </View>
              {/* Tombol "Scan Ulang" */}
              <View style={{ marginBottom:130 }}>
                <Pressable onPress={startScanningAgain} style={{width:LibStyle.width * 0.8,height:40,backgroundColor:'green',alignSelf:'center',alignItems:'center',justifyContent:'center',borderRadius:12}} ><Text style={{color:'white',fontSize:15}}>Scan Lagi</Text></Pressable>
              </View>
            </Camera>
          </LibLazy>
        </View>
        :
        <View style={{ flex: 1, backgroundColor: "#000000" }} >
          <Text>Camera Permission Not Granted</Text>
          <LibLoading />
        </View>
      }
      
    </View>
  );
}

export default memo(m);